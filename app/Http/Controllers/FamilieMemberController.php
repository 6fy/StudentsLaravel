<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BookyearController;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contributie;
use App\Models\Boekjaar;
use App\Models\Lid;
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
            'family' => $family,
            'types' => Lid::all()
        ];

        return view('members.add', [ 'data' => $data ]);
    }

    public function editFamilyMemberView($id)
    {        
        $member = FamilieLid::find($id);
        if ($member == null) return redirect('/members');

        $family = Familie::find($member->family_id);
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
            'user' => $user,
            'types' => Lid::all()
        ];

        return view('members.edit', [ 'data' => $data ]);
    }

    public function familieMemberView($id)
    {
        $family = Familie::find($id);
        if ($family == null) return redirect('/familie');

        $members = FamilieLid::where('family_id', '=', $id)->get();

        $con = array();
        $leftToPay = array();
        foreach ($members as $mem) {
            $contributed = Contributie::where('familie_lid', '=', $mem->id)->get();

            $amount = 0;
            foreach ($contributed as $contribution) {
                $amount += $contribution['amount'];
            }

            $con[$mem->id] = [
                'id' => $mem->id,
                'amount' => $amount
            ];

            $bookyearController = new BookyearController;
            $leftToPay[$mem->id] = [
                'id' => $mem->id,
                'amount' => $bookyearController->getLeftToPay($mem->id)
            ];
        }

        $data = [
            'user' => $user = User::where('id', '=', Session::get('loginId'))->first(),
            'family' => $family,
            'members' => $members,
            'types' => collect(Lid::all()),
            'leftOverContribution' => collect($leftToPay),
            'contribution' => collect($con)
        ];

        return view('members.dashboard', [ 'data' => $data ]);
    }

    public function addFamilyMember(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'birthdate' => 'required'
        ]);

        if ($request->birthdate == null) return back()->with('failed', 'Birthdate is not filled in.');

        $birthdate = date('Y-m-d', strtotime($request->birthdate));
        $now = date('Y-m-d');
        if ($birthdate > $now) return back()->with('failed', 'Birthdate is not valid.');

        $member = new FamilieLid();

        $type = Lid::where('title', '=', $request->type)->first();

        $member->name = $request->name;
        $member->date_of_birth = $request->birthdate;
        $member->lid = $type->id;
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

        return redirect('/members/' . $member->family_id);
    }

    public function editFamilyMember(Request $request, $id)
    {
        $member = FamilieLid::find($id);
        if ($member == null) return back()->with('failed', 'Could not edit family member');

        $request->validate([
            'name' => 'required',
            'birthdate' => 'required'
        ]);

        $type = Lid::where('title', '=', $request->type)->first();

        $member->name = $request->name;
        $member->date_of_birth = $request->birthdate;
        $member->lid = $type->id;
        
        $member->save();

        return redirect('/members/' . $member->family_id);
    }
    
}
