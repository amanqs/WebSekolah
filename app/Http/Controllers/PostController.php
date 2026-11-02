<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::published()->with(['category', 'tags', 'user']);

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('excerpt', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', fn ($q) => $q->where('slug', $request->tag));
        }

        $posts = $query->paginate(9)->withQueryString();
        $categories = Category::withCount('posts')->get();
        $recentPosts = Post::published()->take(5)->get();

        return view('pages.posts.index', compact('posts', 'categories', 'recentPosts'));
    }

    public function show(string $slug): View
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->with(['category', 'tags', 'user'])
            ->firstOrFail();

        // Increment view count
        $post->incrementViews();

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->take(3)
            ->get();

        return view('pages.posts.show', compact('post', 'relatedPosts'));
    }
}

