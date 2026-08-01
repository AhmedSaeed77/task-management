<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SignUpRequest;
use App\Http\Requests\Api\Auth\SignInRequest;
use Illuminate\Http\Request;
use App\Services\Api\AuthService;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $auth)
    {
    }

    public function signUp(SignUpRequest $request)
    {
        return $this->auth->signUp($request);
    }

    public function signIn(SignInRequest $request)
    {
        return $this->auth->signIn($request);
    }

    public function signOut()
    {
        return $this->auth->signOut();
    }
}
