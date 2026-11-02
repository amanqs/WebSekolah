<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::active()->where('slug', $slug)->firstOrFail();
        $otherPages = Page::active()->where('slug', '!=', $slug)->orderBy('id')->get();

        return view('pages.profile', compact('page', 'otherPages'));
    }
}

