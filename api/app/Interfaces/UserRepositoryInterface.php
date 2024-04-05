<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getAllUsers();
    public function createUser($newUser);
    public function getUserById($id);
    public function userDeleteById($id);
    public function updateUserById($userData, $id);
}