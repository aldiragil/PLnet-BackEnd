<?php

namespace App\Interfaces;

interface UserInterface
{

    public function allUser();
    public function getUserById($id);
    public function getUserBy($where);
    public function firstUserBy($where);
    public function createUser(array $data);
    public function updateUser(array $data, $id);
    public function deleteUser($id);

}