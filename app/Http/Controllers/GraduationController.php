<?php

namespace App\Http\Controllers;

use App\Settings\GeneralSettings;
use Illuminate\View\View;

class GraduationController extends Controller
{
    public function index(GeneralSettings $settings): View
    {
        return view('pages.kelulusan.index', compact('settings'));
    }
}

