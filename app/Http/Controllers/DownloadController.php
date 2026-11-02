<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    public function index(Request $request): View
    {
        $query = Download::active();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $downloads = $query->paginate(12)->withQueryString();
        $categories = Download::select('category')->distinct()->pluck('category');

        return view('pages.downloads', compact('downloads', 'categories'));
    }

    public function download(string $slug)
    {
        $download = Download::where('slug', $slug)->firstOrFail();

        // Increment counter
        $download->increment('download_count');

        if (Storage::disk('public')->exists($download->file_path)) {
            $cleanFilename = Str::slug($download->title);
            $extension = $download->file_extension ?: pathinfo($download->file_path, PATHINFO_EXTENSION) ?: 'pdf';
            return Storage::disk('public')->download($download->file_path, "{$cleanFilename}.{$extension}");
        }

        // Fallback: If file missing on disk (e.g. freshly seeded), generate placeholder PDF on the fly
        if (config('app.env') !== 'production' || !Storage::disk('public')->exists($download->file_path)) {
            $content = "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj 2 0 obj<</Type/Pages/Kids[3 0 R]/Count 1>>endobj 3 0 obj<</Type/Page/MediaBox[0 0 612 792]/Parent 2 0 R/Resources<<>>>>endobj\nxref\n0 4\n0000000000 65535 f\n0000000009 00000 n\n0000000052 00000 n\n0000000101 00000 n\ntrailer<</Size 4/Root 1 0 R>>\nstartxref\n178\n%%EOF";
            Storage::disk('public')->put($download->file_path, $content);
            $cleanFilename = Str::slug($download->title);
            $extension = $download->file_extension ?: 'pdf';
            return Storage::disk('public')->download($download->file_path, "{$cleanFilename}.{$extension}");
        }

        return back()->with('error', 'Berkas tidak ditemukan di server.');
    }
}

