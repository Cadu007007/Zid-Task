<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserService
{
    public function attemptUser(array $credentials)
    {
            if(Auth::attempt($credentials))
            {
                $user = $this->getByEmail($credentials['email']);
                 return   [
                    'user'=>$user,
                    'token'=>$user->generateToken('zid-app'),
                ];
            }
        throw new HttpResponseException(response()->json(['success'=>false,'errors'=>['credentials'=>'Credentials Not Correct']], 401)); 

    }
    public function getByEmail($email)
    {
        return User::where('email',$email)->first();
    }
}