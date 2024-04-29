<?php
// app/Repositories/UserRepository.php

namespace App\Repositories;

use App\Models\User; // Assuming your User model is in the App\Models namespace

class UserRepository
{
    public function getAllExceptLoggedInUser()
    {
        return User::where('id', '!=', auth()->id())->get();
    }
}
