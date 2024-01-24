<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserGetResource;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserregisterRequest;
use App\Http\Controllers\ResponseController;


class AuthController extends Controller
{
    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        $password = $request->password;
        if(!$user OR Hash::check($password,$user->password)){
            return ResponseController::error('Email or Password incorrect',401);
        }
        $token = $user->createToken('user')->plainTextToken;
        return ResponseController::data([
            'token' => $token
        ]);
    }
    public function register(UserregisterRequest $request){
        $email = $request->email;
        $user = User::where('email',$email)->first();
        if($user){
            return ResponseController::error('This email already taken',422);
        }
        User::create([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'course_id'=>$request->course_id,
            'email'=>$email,
            'password'=>Hash::make($request->password),
        ]);
        return ResponseController::success('Successfully created',200);
    }
    public function update(UserUpdateRequest $request){
        $user = $request->user();
        $user->update($request->only([
            'name',
            'surname',
            'email',
            'password',
        ]));
        return ResponseController::success('Successfully updated',200);
    }
    public function getme(Request $request){
        $user = auth()->user();
        $user = new UserGetResource($user);
        return $user;
    }
    public function logOut(Request $request){
        $request->user()->currentAccessToken()->delete();
        return ResponseController::success('You have successfully logged out',200);
    }
}
