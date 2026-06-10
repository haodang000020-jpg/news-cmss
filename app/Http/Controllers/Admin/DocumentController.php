<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $documents = Document::query()
            ->with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%'.$search.'%')
                        ->orWhere('code', 'like', '%'.$search.'%')
                        ->orWhere('issuer', 'like', '%'.$search.'%');
                });
            })
            ->when($request->filled('document_category_id'), function ($query) use ($request) {
                $query->where('document_category_id', $request->integer('document_category_id'));
            })
            ->when($request->filled('is_active'), function ($query) use ($request) {
                $query->where('is_active', $request->boolean('is_active'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.documents.index', [
            'documents' => $documents,
            'documentCategories' => $this->documentCategories(),
            'filters' => $request->only(['search', 'document_category_id', 'is_active']),
        ]);
    }

    public function create(): View
    {
        return view('admin.documents.create', [
            'document' => new Document([
                'is_active' => true,
                'is_featured' => false,
                'download_count' => 0,
            ]),
            'documentCategories' => $this->documentCategories(),
        ]);
    }

    public function store(DocumentRequest $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_path'] = Storage::disk('public')->putFile('documents', $file);
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        Document::create($data);

        return redirect()
            ->route('admin.documents.index')
            ->with('status', 'Da them van ban.');
    }

    public function show(Document $document): RedirectResponse
    {
        return redirect()->route('admin.documents.edit', $document);
    }

    public function edit(Document $document): View
    {
        return view('admin.documents.edit', [
            'document' => $document,
            'documentCategories' => $this->documentCategories(),
        ]);
    }

    public function update(DocumentRequest $request, Document $document): RedirectResponse
    {
        $data = $this->validatedData($request, $document);

        if ($request->hasFile('file')) {
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            $file = $request->file('file');
            $data['file_path'] = Storage::disk('public')->putFile('documents', $file);
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        $document->update($data);

        return redirect()
            ->route('admin.documents.index')
            ->with('status', 'Da cap nhat van ban.');
    }

    public function destroy(Document $document): RedirectResponse
    {
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()
            ->route('admin.documents.index')
            ->with('status', 'Da xoa van ban.');
    }

    private function validatedData(DocumentRequest $request, ?Document $document = null): array
    {
        $data = $request->validated();
        unset($data['file']);

        $data['slug'] = $data['slug'] ?: $this->uniqueSlug($data['title'], $document);

        return $data;
    }

    private function uniqueSlug(string $title, ?Document $document = null): string
    {
        $slug = Str::slug($title);
        $baseSlug = $slug;
        $index = 2;

        while (Document::query()
            ->where('slug', $slug)
            ->when($document, fn ($query) => $query->whereKeyNot($document->getKey()))
            ->exists()) {
            $slug = $baseSlug.'-'.$index;
            $index++;
        }

        return $slug;
    }

    private function documentCategories()
    {
        return DocumentCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
