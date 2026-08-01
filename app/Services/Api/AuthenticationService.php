<?php

namespace App\Services\Api;
use App\Repositories\UserRepositoryInterface;

class AuthenticationService
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }
}
