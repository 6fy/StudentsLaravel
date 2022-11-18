<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;

class AuthController extends Controller
{

    public function login() 
    {
        if (Session::has('loginId')) {
            $user = User::where('id', '=', Session::get('loginId'))->first();
            
            $data = [
                'user' => $user
            ];

            return view('dashboard', ['data' => $data]);
        }

        return view('auth.login');
    }

    public function register()
    {
        if (Session::has('loginId')) {
            $user = User::where('id', '=', Session::get('loginId'))->first();

            $data = [
                'user' => $user
            ];

            return view('dashboard', ['data' => $data]);
        }

        return view('auth.register');
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');

            return redirect('/login');
        }
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'password' => 'required|min:3'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->is_admin = 0;

        $res = $user->save();

        if ($res) {
            session()->put('loginId', $user->id);
            $request->session()->put('loginId', $user->id);

            $user = User::where('id', '=', Session::get('loginId'))->first();
            
            $data = [
                'user' => $user
            ];

            return view('/dashboard', ['data' => $data]);
        } else {
            return redirect('/register');
        }
    }

    public function makeAdministrator($id)
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();
        if (!$user) return view('/login');

        $user->is_admin = 1;
        $user->save();

        $data = [
            'user' => $user
        ];

        return view('/dashboard', [ 'data' => $data ]);
    }

    public function loginUser(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:3'
        ]);

        $user = User::where('name', '=', $request->name)->first();
        if (!$user) {
            return back()->with('failed', 'The name or password is incorrect!');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('failed', 'The name or password is incorrect!');
        }

        session()->put('loginId', $user->id);
        $request->session()->put('loginId', $user->id);

        $user = User::where('id', '=', Session::get('loginId'))->first();
            
        $data = [
            'user' => $user
        ];

        return view('/dashboard', ['data' => $data]);
    }

}
