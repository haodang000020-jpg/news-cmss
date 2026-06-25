<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\DigitalAssistantSearchRequest;
use App\Models\AssistantQuery;
use App\Services\ProcedureSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DigitalAssistantController extends Controller
{
    public function index(Request $request): View
    {
        return view('frontend.digital-assistant.index', [
            'initialQuestion' => trim((string) $request->query('q', '')),
            'metaTitle' => 'Trợ lý số Vĩnh Bình',
            'metaDescription' => 'Tra cứu nhanh thủ tục hành chính từ dữ liệu do cơ quan quản trị cập nhật.',
        ]);
    }

    public function search(
        DigitalAssistantSearchRequest $request,
        ProcedureSearchService $searchService
    ): JsonResponse {
        $question = (string) $request->validated('question');

        if ($this->containsSensitiveData($question)) {
            return response()->json([
                'message' => 'Vui lòng không nhập số CCCD, số tài khoản, mã OTP, mật khẩu hoặc thông tin cá nhân nhạy cảm.',
                'results' => [],
            ], 422);
        }

        $results = $searchService->search($question, 3);
        $publicId = (string) Str::uuid();

        AssistantQuery::query()->create([
            'public_id' => $publicId,
            'question' => $question,
            'normalized_question' => $searchService->normalize($question),
            'matched_procedure_id' => $results->first()?->getKey(),
            'result_count' => $results->count(),
            'ip_hash' => $this->hashIp($request->ip()),
            'user_agent' => Str::limit((string) $request->userAgent(), 500, ''),
            'is_resolved' => $results->isNotEmpty(),
        ]);

        $items = $results->map(function ($procedure): array {
            return [
                'name' => $procedure->name,
                'code' => $procedure->code,
                'group' => $procedure->group?->name,
                'summary' => Str::limit(strip_tags((string) $procedure->summary), 170),
                'processing_time' => $procedure->processing_time ?: 'Đang cập nhật',
                'fee' => $procedure->fee ?: 'Đang cập nhật',
                'required_documents_count' => (int) $procedure->required_documents_count,
                'url' => route('frontend.procedures.show', $procedure->slug),
            ];
        })->values();

        return response()->json([
            'query_id' => $publicId,
            'question' => $question,
            'message' => $items->isNotEmpty()
                ? 'Đã tìm thấy thủ tục phù hợp với nội dung bạn nhập.'
                : 'Chưa tìm thấy thủ tục phù hợp. Bạn có thể thử nhập tên giấy tờ, lĩnh vực hoặc nhu cầu cụ thể hơn.',
            'results' => $items,
            'disclaimer' => 'Thông tin được lấy từ dữ liệu thủ tục do cơ quan quản trị cập nhật. Vui lòng xem trang chi tiết để xác nhận trước khi chuẩn bị hồ sơ.',
        ]);
    }

    public function feedback(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'query_id' => ['required', 'uuid'],
            'helpful' => ['required', 'boolean'],
        ]);

        $assistantQuery = AssistantQuery::query()
            ->where('public_id', $validated['query_id'])
            ->first();

        if (! $assistantQuery) {
            return response()->json([
                'message' => 'Không tìm thấy lượt tra cứu cần đánh giá.',
            ], 404);
        }

        $assistantQuery->update([
            'is_helpful' => (bool) $validated['helpful'],
            'feedback_at' => now(),
        ]);

        return response()->json([
            'message' => 'Cảm ơn bạn đã gửi phản hồi.',
        ]);
    }

    private function containsSensitiveData(string $question): bool
    {
        return preg_match('/\b\d{9,16}\b/u', $question) === 1
            || preg_match(
                '/\b(otp|password|mat khau|mật khẩu|so tai khoan|số tài khoản)\b/ui',
                $question
            ) === 1;
    }

    private function hashIp(?string $ip): ?string
    {
        if (! $ip) {
            return null;
        }

        return hash_hmac(
            'sha256',
            $ip,
            (string) config('app.key')
        );
    }
}
