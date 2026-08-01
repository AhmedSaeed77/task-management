<?php

namespace App\Services\Api;

use App\Http\Traits\Responser;
use App\Http\Resources\Api\UserResource;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepositoryInterface;

class AuthService
{
    use Responser;

    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function signUp($request)
    {
        $exist_user = $this->userRepository->first('email', $request->email);

        if ($exist_user)
        {
            return $this->responseFail(message: 'Email Exists');
        }
        DB::beginTransaction();
        try
        {
            $data = $request->validated();
            $user = $this->userRepository->create($data);
            $token = $user->createToken('api')->plainTextToken;
            DB::commit();
            return $this->responseSuccess(message: 'Successfully authenticated',
                                            data: [
                                                    'user' => new UserResource($user),
                                                    'token' => $token
                                               ]);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return $this->responseFail(message: 'Something went wrong');
        }
    }

    public function signIn($request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials))
        {
            return $this->responseFail(status: 401,message: 'wrong credentials');
        }

        $user = auth()->user();
        $token = $user->createToken('api')->plainTextToken;
        return $this->responseSuccess(
            message: 'Successfully authenticated',
            data: [
                'user' => new UserResource($user),
                'token' => $token,
            ]
        );
    }

    public function signOut()
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->responseSuccess(message: 'Successfully loggedOut');
    }
}
