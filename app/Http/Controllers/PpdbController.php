<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use App\Settings\GeneralSettings;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PpdbController extends Controller
{
    public function index(GeneralSettings $settings): View
    {
        return view('pages.ppdb.index', compact('settings'));
    }

    public function printCard(string $registrationNumber, GeneralSettings $settings): Response
    {
        $registration = PpdbRegistration::where('registration_number', $registrationNumber)->firstOrFail();

        $pdf = Pdf::loadView('pages.ppdb.card-pdf', [
            'registration' => $registration,
            'settings' => $settings,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Kartu-PPDB-' . $registration->registration_number . '.pdf');
    }
}

