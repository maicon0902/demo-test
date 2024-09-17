<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $competitions = Competition::with([
            'matches',
            'country',
            'matches.homeTeam',
            'matches.awayTeam',
        ])->get();
        return view('home', compact('competitions'));
    }
}
