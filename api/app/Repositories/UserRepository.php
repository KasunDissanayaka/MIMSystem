<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
// use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model) 
    {
        $this->model = $model;
    }

    public function getAllUsers() : Collection
    {
        return $this->model->all();
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

}