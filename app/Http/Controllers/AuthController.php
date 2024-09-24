<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registration(Request $request){
       $fields= $request->validate([
            'name'=>'required',
            'course'=>'required',
            'age'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        $student= Student::create($fields);

        $token = $student->createToken($request->name);
        return [
            'student'=> $student,
            'token'=> $token->plainTextToken

        ];
    }
    public function login(Request $request){
        $fields= $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $student = Student::where('email',$request->email)->first();

        if(!$student || $request->password != $student->password){
            return [
                'message'=>'students credentials are incorrect'
            ];
        }
        $token = $student->createToken($student->name);
        return [
            'student'=> $student,
            'token'=> $token->plainTextToken

        ];
    }
    public function logout(Request $request){
        // dd($request->user());
    $request->user()->tokens()->delete();
    return [
        "message"=>"you are loged out!" ];
    }


}
