<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Gallery::orderBy('order', 'asc')->orderBy('created_at', 'desc');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('album')) {
            $query->where('album', $request->album);
        }

        $galleries = $query->paginate(12)->withQueryString();
        $albums = Gallery::select('album')->distinct()->pluck('album');

        return view('pages.gallery', compact('galleries', 'albums'));
    }
}

