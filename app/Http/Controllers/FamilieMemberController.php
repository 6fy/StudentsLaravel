<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Familie;
use App\Models\FamilieLid;
use Session;

class FamilieMemberController extends Controller
{
    public function addFamilieMemberView($id)
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();

        $family = Familie::find($id);
        if ($family == null) return redirect('/familie');

        $data = [
            'user' => $user,
            'family' => $family
        ];

        return view('members.add', [ 'data' => $data ]);
    }

    public function editFamilyMemberView($id)
    {        
        $member = FamilieLid::find($id);
        if ($member == null) return redirect('/members');

        $family = Familie::find($member->familie_id);
        if ($family == null) return redirect('/familie');

        $user = User::where('id', '=', Session::get('loginId'))->first();

        $name = ucfirst($member->name);
        if (!str_contains(strtolower($member->name), strtolower($family->name))) {
            $name = $name . " " . ucfirst($family->name);
        }

        $data = [
            'member' => $member,
            'formattedName' => $name,
            'family' => $family,
            'user' => $user
        ];

        return view('members.edit', [ 'data' => $data ]);
    }

    public function familieMemberView($id)
    {
        $family = Familie::find($id);
        if ($family == null) return redirect('/familie');

        $data = [
            'user' => $user = User::where('id', '=', Session::get('loginId'))->first(),
            'family' => $family,
            'members' => FamilieLid::where('familie_id', '=', $id)->get()
        ];

        return view('members.dashboard', [ 'data' => $data ]);
    }

    public function addFamilyMember(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'birthdate' => 'required'
        ]);

        $member = new FamilieLid();

        $member->name = $request->name;
        $member->date_of_birth = $request->birthdate;
        $member->lid = '?';
        $member->family_id = $id;

        $res = $member->save();

        if ($res) {
            return redirect('/members/' . $id);
        } else {
            return back()->with('failed', 'Something went wrong whilst adding this family member!');
        }
    }

    public function deleteFamilyMember($id)
    {
        $member = FamilieLid::find($id);
        if ($member == null) return back()->with('failed', 'Could not delete family member');

        $member->delete();

        return redirect('/members/' . $member->familie_id);
    }

    public function editFamilyMember(Request $request, $id)
    {
        $member = FamilieLid::find($id);
        if ($member == null) return back()->with('failed', 'Could not edit family member');

        $request->validate([
            'name' => 'required',
            'birthdate' => 'required'
        ]);

        $member->name = $request->name;
        $member->date_of_birth = $request->birthdate;
        $member->lid = '?';
        
        $member->save();

        return redirect('/members/' . $member->familie_id);
    }
}
