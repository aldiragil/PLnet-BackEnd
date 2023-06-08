<?php

namespace App\Interfaces;

interface MenuInterface
{
    public function role();
    public function all();
    public function getRoleMenu($id);
    public function getUserMenu($tipe,$id);
    public function updateAccess(array $data);

}