<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Session;

class StudentController extends Controller
{
    public function addStudentView()
    {
        $user = User::where('id', '=', Session::get('loginId'))->first();

        $data = [
            'user' => $user
        ];

        return view('students.add', [ 'data' => $data ]);
    }

    public function editStudentView($id)
    {        
        $student = Student::find($id);
        if ($student == null) return redirect('/');

        $user = User::where('id', '=', Session::get('loginId'))->first();

        $data = [
            'student' => $student,
            'user' => $user
        ];

        return view('students.edit', [ 'data' => $data ]);
    }

    public function addStudent(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        $student = new Student();

        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;

        $occupation = "student";
        if ($request->occupation) {
            $occupation = $request->occupation;
        }

        $student->occupation = $occupation;

        $res = $student->save();

        if ($res) {
            return redirect('/admin');
        } else {
            return back()->with('failed', 'Something went wrong whilst adding this student!');
        }
    }

    public function editStudent(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student == null) return back()->with('failed', 'Could not edit student');

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'occupation' => 'required'
        ]);
        
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->occupation = $request->occupation;
        
        $student->save();

        return redirect('/admin');
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);
        if ($student == null) return back()->with('failed', 'Could not delete student');

        $student->delete();

        return redirect('/admin');
    }
}
