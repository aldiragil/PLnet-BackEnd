<?php

namespace App\Interfaces;

interface CustomerInterface
{
    public function all();
    public function firsBy($where);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);

}