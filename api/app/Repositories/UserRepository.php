<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function getAllUsers()
    {
        return $this->model->all();
    }

    public function createUser($userData)
    {
        $newUser = new User();
        $newUser->fill($userData);
        $newUser->tenant_id = rand(10000,20000);
        $newUser->user_type = "sub_user";
        $newUser->is_active = true;
        $newUser->password = Hash::make($userData['password']);
        $newUser->save();
        
        return $newUser;
    }

    public function getUserById($id)
    {
        return $this->model->find($id);
    }

    public function userDeleteById($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function updateUserById($userData, $id)
    {
        $user = User::find($id);

        if(!$user){
            return false;
        }

        return $user->update($userData);
    }
}