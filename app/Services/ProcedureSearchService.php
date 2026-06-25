<?php

namespace App\Services;

use App\Models\Procedure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProcedureSearchService
{
    private const STOP_WORDS = [
        'a', 'ai', 'anh', 'bao', 'ban', 'bi', 'biet', 'can', 'cua', 'cho',
        'co', 'con', 'dang', 'de', 'den', 'duoc', 'gi', 'giup', 'ho', 'hoi',
        'khong', 'lam', 'la', 'minh', 'muon', 'nay', 'nhu', 'o', 'phai',
        'ra', 'sao', 'tai', 'the', 'thi', 'toi', 'tren', 'tu', 'va', 've',
        'voi', 'xin', 'yeu',
    ];

    private const SYNONYM_PHRASES = [
        'con moi sinh' => ['dang ky khai sinh', 'khai sinh tre em'],
        'em be moi sinh' => ['dang ky khai sinh', 'khai sinh tre em'],
        'giay khai sinh' => ['dang ky khai sinh'],
        'giay doc than' => ['xac nhan tinh trang hon nhan'],
        'xac nhan doc than' => ['xac nhan tinh trang hon nhan'],
        'doc than' => ['tinh trang hon nhan'],
        'dang ky cuoi' => ['dang ky ket hon'],
        'ket hon' => ['dang ky ket hon', 'hon nhan'],
        'tro cap nguoi gia' => ['tro cap nguoi cao tuoi', 'bao tro xa hoi'],
        'nguoi cao tuoi' => ['bao tro xa hoi', 'tro cap xa hoi'],
        'ho ngheo' => ['ho ngheo', 'bao tro xa hoi', 'an sinh xa hoi'],
        'nguoi co cong' => ['chinh sach nguoi co cong'],
        'khuyet tat' => ['nguoi khuyet tat', 'bao tro xa hoi'],
        'tham gia van hoa' => ['hoat dong van hoa', 'the thao cong dong'],
        'the thao' => ['hoat dong the thao', 'van hoa the thao'],
    ];

    public function search(string $question, int $limit = 3): Collection
    {
        $normalizedQuestion = $this->normalize($question);
        $phrases = $this->expandedPhrases($normalizedQuestion);
        $tokens = $this->tokens(implode(' ', $phrases));

        return Procedure::query()
            ->with('group:id,name,is_active')
            ->withCount('requiredDocuments')
            ->active()
            ->whereHas('group', fn ($query) => $query->where('is_active', true))
            ->get()
            ->map(function (Procedure $procedure) use (
                $normalizedQuestion,
                $phrases,
                $tokens
            ): Procedure {
                $procedure->setAttribute(
                    'assistant_score',
                    $this->score(
                        $procedure,
                        $normalizedQuestion,
                        $phrases,
                        $tokens
                    )
                );

                return $procedure;
            })
            ->filter(
                fn (Procedure $procedure): bool =>
                    (float) $procedure->getAttribute('assistant_score') >= 10
            )
            ->sortBy([
                ['assistant_score', 'desc'],
                ['is_featured', 'desc'],
                ['sort_order', 'asc'],
                ['name', 'asc'],
            ])
            ->take(max(1, min($limit, 5)))
            ->values();
    }

    public function normalize(string $text): string
    {
        $text = Str::ascii(Str::lower(trim($text)));
        $text = preg_replace('/[^a-z0-9\s-]+/', ' ', $text) ?? '';
        $text = preg_replace('/\s+/', ' ', $text) ?? '';

        return trim($text);
    }

    private function expandedPhrases(string $normalizedQuestion): array
    {
        $phrases = [$normalizedQuestion];

        foreach (self::SYNONYM_PHRASES as $needle => $synonyms) {
            if (Str::contains($normalizedQuestion, $needle)) {
                $phrases = array_merge($phrases, $synonyms);
            }
        }

        return array_values(array_unique(array_filter($phrases)));
    }

    private function tokens(string $text): array
    {
        $tokens = preg_split('/\s+/', $this->normalize($text)) ?: [];

        return array_values(array_unique(array_filter(
            $tokens,
            fn (string $token): bool =>
                strlen($token) >= 2
                && ! in_array($token, self::STOP_WORDS, true)
        )));
    }

    private function score(
        Procedure $procedure,
        string $normalizedQuestion,
        array $phrases,
        array $tokens
    ): float {
        $name = $this->normalize((string) $procedure->name);
        $code = $this->normalize((string) $procedure->code);
        $keywords = $this->normalize((string) $procedure->keywords);
        $summary = $this->normalize((string) $procedure->summary);
        $applicants = $this->normalize((string) $procedure->applicants);
        $agency = $this->normalize((string) $procedure->implementing_agency);
        $group = $this->normalize((string) $procedure->group?->name);

        $score = 0.0;

        if ($normalizedQuestion !== '') {
            if ($name === $normalizedQuestion) {
                $score += 130;
            } elseif (Str::contains($name, $normalizedQuestion)) {
                $score += 80;
            }

            if ($code !== '' && $code === $normalizedQuestion) {
                $score += 120;
            }
        }

        foreach ($phrases as $phrase) {
            $phrase = $this->normalize($phrase);

            if ($phrase === '') {
                continue;
            }

            if (Str::contains($name, $phrase)) {
                $score += 55;
            }

            if (Str::contains($keywords, $phrase)) {
                $score += 38;
            }

            if (Str::contains($summary, $phrase)) {
                $score += 20;
            }

            if (Str::contains($group, $phrase)) {
                $score += 18;
            }
        }

        foreach ($tokens as $token) {
            if (Str::contains($name, $token)) {
                $score += 15;
            }

            if (Str::contains($keywords, $token)) {
                $score += 11;
            }

            if (Str::contains($group, $token)) {
                $score += 8;
            }

            if (Str::contains($summary, $token)) {
                $score += 5;
            }

            if (Str::contains($applicants, $token)) {
                $score += 4;
            }

            if (Str::contains($agency, $token)) {
                $score += 3;
            }
        }

        if ($normalizedQuestion !== '' && $name !== '') {
            similar_text($normalizedQuestion, $name, $similarity);

            if ($similarity >= 50) {
                $score += ($similarity - 45) * 0.7;
            }
        }

        if ($procedure->is_featured) {
            $score += 2;
        }

        return round($score, 2);
    }
}
