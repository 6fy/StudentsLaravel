<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();
        return view('dashboard', compact('user'));
    }

    public function admin()
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();
        return view('admin', compact('user'));
    }
}
