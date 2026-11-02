<?php

namespace App\Http\Controllers;

use App\Models\BukuNonTeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BukuNonTeksController extends Controller
{
    public function index(Request $request): View
    {
        $query = BukuNonTeks::active()->latest();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('q')) {
            $searchTerm = '%' . $request->q . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('author', 'like', $searchTerm)
                  ->orWhere('publisher', 'like', $searchTerm)
                  ->orWhere('synopsis', 'like', $searchTerm)
                  ->orWhere('isbn', 'like', $searchTerm);
            });
        }

        $books = $query->paginate(12)->withQueryString();

        $categories = BukuNonTeks::active()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category');

        $totalBooks = BukuNonTeks::active()->count();
        $totalDownloads = BukuNonTeks::active()->sum('download_count');

        return view('pages.buku-non-teks.index', compact('books', 'categories', 'totalBooks', 'totalDownloads'));
    }

    public function download(string $slug)
    {
        $book = BukuNonTeks::where('slug', $slug)->firstOrFail();

        $book->increment('download_count');

        if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
            $cleanFilename = Str::slug($book->title);
            $extension = $book->file_extension ?: pathinfo($book->file_path, PATHINFO_EXTENSION) ?: 'pdf';
            return Storage::disk('public')->download($book->file_path, "Buku-{$cleanFilename}.{$extension}");
        }

        // Safe Fallback for local/test seeders: create placeholder PDF
        $cleanFilename = Str::slug($book->title);
        $extension = $book->file_extension ?: 'pdf';
        $path = $book->file_path ?: 'buku-non-teks/' . $book->slug . '.pdf';

        if (!Storage::disk('public')->exists($path)) {
            $pdfContent = "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj 2 0 obj<</Type/Pages/Kids[3 0 R]/Count 1>>endobj 3 0 obj<</Type/Page/MediaBox[0 0 612 792]/Parent 2 0 R/Resources<<>>>>endobj\nxref\n0 4\n0000000000 65535 f\n0000000009 00000 n\n0000000052 00000 n\n0000000101 00000 n\ntrailer<</Size 4/Root 1 0 R>>\nstartxref\n178\n%%EOF";
            Storage::disk('public')->put($path, $pdfContent);
        }

        return Storage::disk('public')->download($path, "Buku-{$cleanFilename}.{$extension}");
    }
}

