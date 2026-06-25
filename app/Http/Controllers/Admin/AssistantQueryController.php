<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssistantQuery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssistantQueryController extends Controller
{
    public function index(Request $request): View
    {
        $filters = [
            'search' => trim((string) $request->query('search', '')),
            'status' => (string) $request->query('status', ''),
            'feedback' => (string) $request->query('feedback', ''),
        ];

        $queries = AssistantQuery::query()
            ->with('matchedProcedure:id,name,slug')
            ->when($filters['search'] !== '', function ($query) use ($filters): void {
                $query->where('question', 'like', '%'.$filters['search'].'%');
            })
            ->when($filters['status'] === 'resolved', fn ($query) => $query->where('is_resolved', true))
            ->when($filters['status'] === 'unresolved', fn ($query) => $query->where('is_resolved', false))
            ->when($filters['feedback'] === 'helpful', fn ($query) => $query->where('is_helpful', true))
            ->when($filters['feedback'] === 'not_helpful', fn ($query) => $query->where('is_helpful', false))
            ->when($filters['feedback'] === 'none', fn ($query) => $query->whereNull('is_helpful'))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        $stats = [
            'total' => AssistantQuery::query()->count(),
            'resolved' => AssistantQuery::query()->where('is_resolved', true)->count(),
            'unresolved' => AssistantQuery::query()->where('is_resolved', false)->count(),
            'not_helpful' => AssistantQuery::query()->where('is_helpful', false)->count(),
        ];

        return view('admin.assistant-queries.index', [
            'queries' => $queries,
            'filters' => $filters,
            'stats' => $stats,
        ]);
    }
}
