<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FamilieLid;
use Session;

class FamilieMemberController extends Controller
{
    public function addFamilieMemberView()
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();

        $data = [
            'user' => $user
        ];

        return view('members.add', [ 'data' => $data ]);
    }

    public function editFamilyMemberView($id)
    {        
        $member = FamilieLid::find($id);
        if ($member == null) return redirect('/members');

        $user = User::where('id', '=', Session::get('loginId'))->first();

        $data = [
            'member' => $member,
            'user' => $user
        ];

        return view('members.edit', [ 'data' => $data ]);
    }

    public function familieMemberView()
    {
        $data = [
            'user' => $user = User::where('id', '=', Session::get('loginId'))->first(),
            'members' => FamilieLid::all()
        ];

        return view('members.dashboard', [ 'data' => $data ]);
    }

    public function addFamilyMember(Request $request)
    {
        $request->vaFamilieLidate([
            'name' => 'required',
            'birthDate' => 'required',
            'memberType' => 'required',
            'familyId' => 'required',
        ]);

        $member = new FamilieLid();

        $member->naam = $request->name;
        $member->geboorte_datum = $request->birthDate;
        $member->lid = $request->memberType;
        $member->familie_id = $request->familyId;

        $res = $member->save();

        if ($res) {
            return redirect('/members');
        } else {
            return back()->with('failed', 'Something went wrong whilst adding this family member!');
        }
    }

    public function deleteFamilyMember($id)
    {
        $member = FamilieLid::find($id);
        if ($member == null) return back()->with('failed', 'Could not delete family member');

        $member->delete();

        return redirect('/members');
    }

    public function editFamilyMember(Request $request, $id)
    {
        $member = FamilieLid::find($id);
        if ($member == null) return back()->with('failed', 'Could not edit family member');

        $request->vaFamilieLidate([
            'name' => 'required',
            'birthDate' => 'required',
            'memberType' => 'required',
            'familyId' => 'required',
        ]);

        $member->naam = $request->name;
        $member->geboorte_datum = $request->birthDate;
        $member->lid = $request->memberType;
        $member->familie_id = $request->familyId;
        
        $member->save();

        return redirect('/members');
    }
}
