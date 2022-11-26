<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lid;
use App\Models\Contributie;
use App\Models\FamilieLid;
use App\Models\Boekjaar;
use Session;

class BookYearController extends Controller
{
    public function bookyearDashboardView()
    {
        $data = [
            'user' => $user = User::where('id', '=', Session::get('loginId'))->first(),
            'bookyear' => Boekjaar::all()->sortByDesc("bookyear")
        ];

        return view('bookyear.dashboard', [ 'data' => $data ]);
    }

    public function addBookyearView()
    {
        $data = [
            'user' => $user = User::where('id', '=', Session::get('loginId'))->first()
        ];

        return view('bookyear.add', [ 'data' => $data ]);
    }

    public function editBookyearView($id)
    {
        $data = [
            'user' => $user = User::where('id', '=', Session::get('loginId'))->first(),
            'bookyear' => Boekjaar::find($id)
        ];

        return view('bookyear.edit', [ 'data' => $data ]);
    }

    public function addBookyear(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric',
            'contribution' => 'required|numeric'
        ]);

        $bookyear = new Boekjaar();
        $bookyear->bookyear = $request->year;
        $bookyear->contribution = $request->contribution;

        $bookyear->save();

        return redirect('/bookyear')->with('success', 'Bookyear added!');
    }

    public function editBookyear(Request $request, $id)
    {
        $request->validate([
            'year' => 'required|numeric',
            'contribution' => 'required|numeric'
        ]);

        $bookyear = Boekjaar::find($id);
        $bookyear->bookyear = $request->year;
        $bookyear->contribution = $request->contribution;
        $bookyear->save();

        return redirect('/bookyear')->with('success', 'Bookyear edited!');
    }

    public function deleteBookyear(Request $request, $id)
    {
        $bookyear = Boekjaar::find($id);
        $bookyear->delete();

        return redirect('/bookyear')->with('success', 'Bookyear deleted!');
    }

    public function getLeftToPay($id) 
    {
        $currentYear = date('Y');
        $year = Boekjaar::where('bookyear', $currentYear)->first();
        if ($year == null) return 0;

        $paid_contribution = Contributie::where('familie_lid', $id)->where('bookyear_id', $year->id)->get();
        $paid = $paid_contribution->sum('amount');
        $total = $year->contribution;
    
        $member = FamilieLid::find($id);
        $lidtype = Lid::where('id', '=', $member->lid)->first();

        $percentage = (int) filter_var(explode('jaar', $lidtype->description)[1], FILTER_SANITIZE_NUMBER_INT);
        $percentage = ($percentage == 0) ? 1 : 1 - ($percentage / 100);

        $needsToPay = $total * $percentage;
        return $needsToPay - $paid;
    }

}
