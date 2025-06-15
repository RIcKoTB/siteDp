<?php

namespace App\Http\Controllers;

use App\Models\ProgramOverview;
use App\Models\CoreValue;
use App\Models\TeamMember;
use App\Models\HistoryEvent;

class AboutController extends Controller
{
    public function index()
    {
        return view('about', [
            'mission' => ProgramOverview::where('title', 'Наша місія')->first(),
            'values' => CoreValue::all(),
            'teamMembers' => TeamMember::all(),
            'history' => HistoryEvent::orderBy('event_year')->get(),
        ]);

    }
}
