<?php
namespace App\Services;

use App\Services\UserService;

class LoginService
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function execute(array $data)
    {
        return $this->userService->attemptUser($data);
    }
}