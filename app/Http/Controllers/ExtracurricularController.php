<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExtracurricularController extends Controller
{
    public function index(Request $request): View
    {
        $query = Extracurricular::active();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('coach', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        $extracurriculars = $query->paginate(12)->withQueryString();

        return view('pages.extracurriculars', compact('extracurriculars'));
    }
}

