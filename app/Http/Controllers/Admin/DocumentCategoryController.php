<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentCategoryRequest;
use App\Models\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DocumentCategoryController extends Controller
{
    public function index(): View
    {
        $documentCategories = DocumentCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.document-categories.index', [
            'documentCategories' => $documentCategories,
        ]);
    }

    public function create(): View
    {
        return view('admin.document-categories.create', [
            'documentCategory' => new DocumentCategory(['is_active' => true, 'sort_order' => 0]),
        ]);
    }

    public function store(DocumentCategoryRequest $request): RedirectResponse
    {
        DocumentCategory::create($request->validated());

        return redirect()
            ->route('admin.document-categories.index')
            ->with('status', 'Da them loai van ban.');
    }

    public function edit(DocumentCategory $documentCategory): View
    {
        return view('admin.document-categories.edit', [
            'documentCategory' => $documentCategory,
        ]);
    }

    public function update(DocumentCategoryRequest $request, DocumentCategory $documentCategory): RedirectResponse
    {
        $documentCategory->update($request->validated());

        return redirect()
            ->route('admin.document-categories.index')
            ->with('status', 'Da cap nhat loai van ban.');
    }

    public function destroy(DocumentCategory $documentCategory): RedirectResponse
    {
        if (Schema::hasColumn('documents', 'document_category_id') && $documentCategory->documents()->exists()) {
            return redirect()
                ->route('admin.document-categories.index')
                ->with('error', 'Khong the xoa loai van ban dang co van ban.');
        }

        $documentCategory->delete();

        return redirect()
            ->route('admin.document-categories.index')
            ->with('status', 'Da xoa loai van ban.');
    }
}
