<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BookyearController;

use Illuminate\Http\Request;
use App\Models\FamilieLid;
use App\Models\Boekjaar;
use App\Models\Contributie;
use App\Models\Lid;
use App\Models\Familie;
use App\Models\User;
use Session;

class ContributionController extends Controller
{
    public function contributionDashboardView($id)
    {
        $member = FamilieLid::find($id);
        if ($member == null) return redirect('/familie');

        $family = Familie::find($member->family_id);
        if ($family == null) return redirect('/familie');

        $name = ucfirst($member->name);
        if (!str_contains(strtolower($member->name), strtolower($family->name))) {
            $name = $name . " " . ucfirst($family->name);
        }

        $contribution = Contributie::where('familie_lid', '=', $member->id)->get();

        $data = [
            'user' => $user = User::where('id', '=', Session::get('loginId'))->first(),
            'family' => $family,
            'contribution' => ($contribution ? $contribution : array()),
            'formattedName' => $name,
            'member' => $member,
            'bookyears' => Boekjaar::all()
        ];

        return view('contribution.dashboard', [ 'data' => $data ]);
    }

    public function addContributionView($id) 
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();

        $member = FamilieLid::find($id);
        if ($member == null) return redirect('/familie');

        $bookyearController = new BookyearController;
        $data = [
            'user' => $user,
            'member' => $member,
            'leftOverContribution' => $bookyearController->getLeftToPay($member->id),
            'bookyears' => Boekjaar::all()->sortByDesc("bookyear")
        ];

        return view('contribution.add', [ 'data' => $data ]);
    }

    public function editContributionView($id) 
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();

        $con = Contributie::find($id);
        if ($con == null) return redirect('/familie');

        $member = FamilieLid::find($con->familie_lid);
        if ($member == null) return redirect('/familie');

        $bookyear = Boekjaar::find($con->bookyear_id);
        if ($bookyear == null) return redirect('/familie');

        $bookyearController = new BookyearController;
        $data = [
            'user' => $user,
            'contribution' => $con,
            'bookyear' => $bookyear,
            'member' => $member,
            'leftOverContribution' => $bookyearController->getLeftToPay($member->id),
            'bookyears' => Boekjaar::all()->sortByDesc("bookyear")
        ];

        return view('contribution.edit', [ 'data' => $data ]);
    }

    public function addContribution(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'bookyear' => 'required|numeric'
        ]);

        $member = FamilieLid::find($id);
        if (!$member) return redirect('/familie');

        $bookyear = Boekjaar::where('id', '=', $request->bookyear)->first();
        if (!$bookyear) return redirect('/familie');

        $con = new Contributie();

        $con->age = $this->calculateAge($member->date_of_birth);
        $con->lid_type = $member->lid;
        $con->amount = $request->amount;
        $con->familie_lid = $member->id;
        $con->bookyear_id = $bookyear->id;
        
        $res = $con->save();

        return $this->contributionDashboardView($id);
    }

    public function calculateAge($birthDate)
    {
        // English and dutch dates will mess up the format so add a check for that
        $character = str_contains($birthDate, "/") ? "/" : "-";
        $birthDate = explode($character, $birthDate);

        $day = $character == "/" ? 0 : 2;
        $year = $character == "/" ? 2 : 0;

        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[$day], $birthDate[1], $birthDate[$year]))) > date("md")
            ? ((date("Y") - $birthDate[$year]) - 1)
            : (date("Y") - $birthDate[$year]));

        return $age;
    }

    public function editContribution(Request $request, $id)
    {
        $request->validate([
            'age' => 'numeric',
            'bookyear' => 'numeric',
            'amount' => 'required|numeric'
        ]);

        $con = Contributie::find($id);
        if (!$con) return redirect('/familie');

        $member = FamilieLid::find($con->familie_lid);
        if (!$member) return redirect('/familie');

        // create new object
        $con->amount = $request->amount;

        if (isset($request->amount)) {
            $con->age = $request->age;
        }

        if (isset($request->bookyear)) {
            $bookyear = Boekjaar::where('id', '=', $request->bookyear)->first();
            if (!$bookyear) return redirect('/familie');
            $con->bookyear_id = $bookyear->id;
        }
        
        $res = $con->save();

        return $this->contributionDashboardView($con->familie_lid);
    }

    public function deleteContribution($id)
    {
        $con = Contributie::find($id);
        if ($con == null) return back()->with('failed', 'Could not delete contribution');

        $memberId = $con->familie_lid;
        $con->delete();

        return redirect('/contribution/' . $memberId);
    }

}
