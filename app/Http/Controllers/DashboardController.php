<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Returns dashboard view with all of user's meetings
     */
    public function __invoke()
    {
        return view('dashboard', [
            'meetings' => Meeting::where('user_id', Auth::user()->id)->simplePaginate(12),
        ]);
    }
}
