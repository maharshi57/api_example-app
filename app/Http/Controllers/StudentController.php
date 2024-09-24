<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return student::all();
    }

    public function store(Request $request)
    {
        $fileds= $request->validate([
            'name'=>'required',
            'course'=>'required',
            'age' => 'required',
            'email'=>'required',
            'password'=>'required'

        ]);
        $student= Student::create($fileds);

        $token = $student->createToken($request->name);
        return [
            'student'=> $student,
            'token'=> $token->plainTextToken
        ];

        // return [ 'student' => $student ];
    }

    public function show(Student $student)
    {
        return response()->json($student);
    }

    public function update(Request $request, Student $student)
    {
        $fileds= $request->validate([
            'name'=>'required',
            'course'=>'required',
            'age' => 'required',
            'email'=>'required'|'email',
            'password'=>'required'
        ]);
        $student->update($fileds);

        // $token = $student->createToken($request->name);
        // return [
        //     'student'=> $student,
        //     'token'=> $token->plainTextToken
        // ];
        return response()->json([
            "message"=>"student details successfully",
            "student"=>$student
        ]) ;
        }

    public function destroy(Student $student)
    {
        $student ->delete();
    }
}
