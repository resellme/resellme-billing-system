<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Domain;

class UserDashboardController extends Controller
{
    public function index() {
        $user = \Auth::user();

        return view('user.dashboard', compact('user'));
    }
}
