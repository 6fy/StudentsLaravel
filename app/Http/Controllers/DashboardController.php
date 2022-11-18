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
        if (!$user) return view('auth.login');

        $data = [
            'user' => $user
        ];

        return view('dashboard', [ 'data' => $data ]);
    }
}
