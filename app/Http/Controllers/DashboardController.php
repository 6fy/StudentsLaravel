<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Student;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();

        $data = [
            'user' => $user
        ];

        return view('dashboard', [ 'data' => $data ]);
    }

    public function admin()
    {
        $data = [
            'user' => User::where('id', '=', Session::get('loginId'))->first(),
            'students' => Student::all()
        ];

        return view('admin', [ 'data' => $data ] );
    }
}
