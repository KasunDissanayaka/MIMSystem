<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface 
{
    public function getAllUsers() : Collection;
    public function findByEmail($email);
}