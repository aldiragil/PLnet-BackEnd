<?php

namespace App\Interfaces;

interface RemovalInterface
{
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);

}