<?php

namespace App\Interfaces;

interface ComplaintInterface
{
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);

}