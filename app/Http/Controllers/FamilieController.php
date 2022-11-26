<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BookyearController;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lid;
use App\Models\Familie;
use App\Models\Contributie;
use App\Models\Boekjaar;
use App\Models\FamilieLid;
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
        $families = Familie::all();

        $con = array();
        $leftToPay = array();
        foreach ($families as $fam) {
            $members = FamilieLid::where('family_id', '=', $fam->id)->get();

            $unpaid = 0;
            $paid = 0;
            foreach ($members as $mem) {
                $contributed = Contributie::where('familie_lid', '=', $mem->id)->get();

                foreach ($contributed as $contribution) {
                    $paid += $contribution['amount'];
                }

                $bookyearController = new BookyearController;
                $unpaid += $bookyearController->getLeftToPay($mem->id);
            }

            $con[$fam->id] = [
                'id' => $fam->id,
                'amount' => $paid
            ];

            $leftToPay[$fam->id] = [
                'id' => $fam->id,
                'amount' => $unpaid
            ];
        }

        $data = [
            'user' => $user = User::where('id', '=', Session::get('loginId'))->first(),
            'families' => $families,
            'leftOverContribution' => collect($leftToPay),
            'contribution' => collect($con)
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
