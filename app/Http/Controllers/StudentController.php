<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Http\Request;
// use Illuminate\Routing\Controllers\HasMiddleware;
// use Illuminate\Routing\Controllers\Middleware;

class StudentController extends Controller //implements HasMiddleware
{
    // public static function middleware(){
    //     return
    //         [
    //             new middleware('auth:sanctum', except: ['index', 'show'])
    //         ];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return student::all();
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        // $student = Auth::$student();
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
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
        return $student ;    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student ->delete();
    }
}
