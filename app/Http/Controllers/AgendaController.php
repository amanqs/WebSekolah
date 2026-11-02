<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(): View
    {
        $agendas = Agenda::active()->orderBy('start_date', 'asc')->paginate(10);
        return view('pages.agenda', compact('agendas'));
    }
}

