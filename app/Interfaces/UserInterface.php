<?php

namespace App\Interfaces;

interface UserInterface
{

    public function allUser();
    public function firstUserBy($where);
    public function createUser(array $data);
    public function updateUser(array $data, $id);
    public function deleteUser($id);

}