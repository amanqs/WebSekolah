<?php

namespace App\Http\Controllers;

use App\Settings\GeneralSettings;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(GeneralSettings $settings): View
    {
        return view('pages.contact', compact('settings'));
    }
}

