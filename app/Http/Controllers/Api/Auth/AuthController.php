<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Api\Auth\AuthService;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $auth)
    {
    }
}
