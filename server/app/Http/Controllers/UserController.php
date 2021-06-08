<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\SignupReq;
use Illuminate\Http\Request;
use App\Http\Requests\LoginReq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ChangeUserDataReq;

class UserController extends Controller
{

    public function changeUserData(ChangeUserDataReq $request){
        $val = $request->validated();
        $validated = array_filter($val,function($value){
            return !empty($value);
        });

        Auth::user()->update($validated);
        return response()->json([
            'status' => 200,

        ]);
    }

    public function signup(SignupReq $request){
        $validated = $request->validated();
        User::create($validated);
        return response()->json([
            'statues' => 200,
        ]);
    }

    public function login(LoginReq $request){
        $response = Http::asForm()->post('http://narek.test/oauth/token',[
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => '9tMuzRPGAlrYDDHBnA8hHWpzj2ZHfjN6H36CAfAG',
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*'
        ]);

        return $response->json()['access_token'];
    }

    public function getUserData(){
        return response()->json([
           'status' => 200,
           'data' => Auth::user()->only('name','email','id')
        ]);
    }
}
