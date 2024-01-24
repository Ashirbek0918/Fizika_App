<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ResponseController;

class EmployeeController extends Controller
{
    public function login(Request $request){
        $user = Admin::where('email', $request->email)->first();
        $password = $request->password;
        if(!$user OR !Hash::check($password,$user->password)){
            return ResponseController::error('Email or Password incorrect',401);
        }
        $token = $user->createToken('admin')->plainTextToken;
        return ResponseController::data([
            'token' => $token
        ]);
    }
    public function update(Request $request,Employee $employee){
        $employee->update([
            'password' => $request->password
        ]);
        return ResponseController::success('Employee updated successfully',200);
    }
}
