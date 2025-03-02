<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(AuthRequest $request){
        $data = $request->validated();
        $user = User::where('email',$data['email'])->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email' => ['The provied credentials are incorrect']
            ]);
        };
        
        if(!Hash::check($data['password'],$user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provied credentials are incorrect']
            ]);
        }
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }
    
    public function logout(AuthRequest $request){
       
    }
}