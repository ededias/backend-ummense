<?php

namespace App\Modules\Login\Http\Controllers;

use App\Models\User;
use App\Modules\Login\Http\Request\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthenticateController {
    
    public function __construct() {
       
    }

    public function login(UserRequest $request) 
    {
       
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

}