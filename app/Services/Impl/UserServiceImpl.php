<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        'admin' => 'admin'
    ];
    
    public function login(string $user, string $password): bool 
    {
        if (!isset($this->users[$user])) { // Fix: Check if user exists in the users array
            return false;
        }
        
        $correctpassword = $this->users[$user];
        if ($password !== $correctpassword){ // Fix: Use strict comparison to compare passwords
            return false;
        }
        
        return true;
    }
}
