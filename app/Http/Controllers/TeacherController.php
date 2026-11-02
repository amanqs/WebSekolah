<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(Request $request): View
    {
        $query = Teacher::active();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->q}%")
                  ->orWhere('position', 'like', "%{$request->q}%")
                  ->orWhere('subject', 'like', "%{$request->q}%");
            });
        }

        $teachers = $query->paginate(12)->withQueryString();

        return view('pages.teachers', compact('teachers'));
    }
}

