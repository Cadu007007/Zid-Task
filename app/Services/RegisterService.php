<?php
namespace App\Services;

use App\Models\User;

class RegisterService
{
    public function execute(array $data)
    {
        // when user created password hashed in the model
        $user = User::create($data);
        $token =$user->generateToken('zid-app');
        return[
            'user'=>$user,
            'token'=>$token,
        ];
    }

}