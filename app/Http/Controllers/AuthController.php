<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\LoginService;
use App\Services\RegisterService;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:sanctum')->except('logout');
    }
    public function register(RegisterRequest $request,RegisterService $registerService)
    {
        $response = $registerService->execute($request->validated());
        return $this->JsonResponse(true,$response,'User Register Successfully',201);
    }
    public function login(LoginRequest $request,LoginService $loginService)
    {
        $response = $loginService->execute($request->validated());
        return $this->JsonResponse(true,$response,'User Logged In Successfully',200);
        
    }
    public function logout()
    {
        // this delete every where user logged in
        // return auth('sanctum')->user();
        auth('sanctum')->user()->tokens()->delete();
        return $this->JsonResponse(true,[],'User Logged Out Successfully',200);
        
    }
}
