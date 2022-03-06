<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Domain;

class UserDashboardController extends Controller
{
    public function index() {
        $domains = Domain::where([
            'user_id' => Auth::id(),
        ])->get();

        return view('user.dashboard', compact('domains'));
    }
}
