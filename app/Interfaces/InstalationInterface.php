<?php

namespace App\Interfaces;

interface InstalationInterface
{
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);

}