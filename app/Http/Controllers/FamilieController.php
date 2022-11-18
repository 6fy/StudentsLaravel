<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Familie;
use Session;

class FamilieController extends Controller
{
    public function addFamilieView()
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();

        $data = [
            'user' => $user
        ];

        return view('familie.add', [ 'data' => $data ]);
    }

    public function editFamilyView($id)
    {        
        $family = Familie::find($id);
        if ($family == null) return redirect('/familie');

        $user = User::where('id', '=', Session::get('loginId'))->first();

        $data = [
            'family' => $family,
            'user' => $user
        ];

        return view('familie.edit', [ 'data' => $data ]);
    }

    public function familieView()
    {
        $data = [
            'user' => $user = User::where('id', '=', Session::get('loginId'))->first(),
            'families' => Familie::all()
        ];

        return view('familie.dashboard', [ 'data' => $data ]);
    }

    public function addFamily(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        $familie = new Familie();

        $familie->name = $request->name;
        $familie->address = $request->address;

        $res = $familie->save();

        if ($res) {
            return redirect('/familie');
        } else {
            return back()->with('failed', 'Something went wrong whilst adding this family!');
        }
    }

    public function deleteFamily($id)
    {
        $familie = Familie::find($id);
        if ($familie == null) return back()->with('failed', 'Could not delete family');

        $familie->delete();

        return redirect('/familie');
    }

    public function editFamily(Request $request, $id)
    {
        $familie = Familie::find($id);
        if ($familie == null) return back()->with('failed', 'Could not edit family');

        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        $familie->name = $request->name;
        $familie->address = $request->address;
        
        $familie->save();

        return redirect('/familie');
    }

}
