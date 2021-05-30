<?php

namespace App\Interfaces;

use App\User;

interface LoginInterface {

    public function generateToken(User $user);
    
}