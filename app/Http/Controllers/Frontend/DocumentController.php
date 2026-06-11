<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->query('q', ''));
        $documentCategoryId = $request->query('document_category_id');

        $documents = Document::query()
            ->with('category')
            ->where('is_active', true)
            ->when($keyword !== '', function ($query) use ($keyword): void {
                $query->where(function ($query) use ($keyword): void {
                    $query->where('title', 'like', "%{$keyword}%")
                        ->orWhere('code', 'like', "%{$keyword}%")
                        ->orWhere('issuer', 'like', "%{$keyword}%")
                        ->orWhere('summary', 'like', "%{$keyword}%");
                });
            })
            ->when($documentCategoryId, function ($query) use ($documentCategoryId): void {
                $query->where('document_category_id', $documentCategoryId);
            })
            ->orderByDesc('issued_at')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $documentCategories = DocumentCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('frontend.documents.index', [
            'documents' => $documents,
            'documentCategories' => $documentCategories,
            'keyword' => $keyword,
            'selectedDocumentCategoryId' => $documentCategoryId,
            'metaTitle' => 'Văn bản chỉ đạo điều hành',
            'metaDescription' => 'Danh sách văn bản chỉ đạo điều hành',
        ]);
    }

    public function show(string $slug): View
    {
        $document = Document::query()
            ->with('category')
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.documents.show', [
            'document' => $document,
            'metaTitle' => $document->title,
            'metaDescription' => $document->summary,
        ]);
    }

    public function download(Document $document): StreamedResponse
    {
        if (
            ! $document->is_active
            || ! $document->file_path
            || ! Storage::disk('public')->exists($document->file_path)
        ) {
            abort(404);
        }

        $document->increment('download_count');

        $fileName = $document->file_name ?: basename($document->file_path);

        return Storage::disk('public')->download($document->file_path, $fileName);
    }
}
