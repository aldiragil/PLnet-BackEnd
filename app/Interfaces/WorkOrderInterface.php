<?php

namespace App\Interfaces;

interface WorkOrderInterface
{

    public function all();
    public function getById($id);
    public function create($data, $user_id);
    public function update($data, $user_id, $id);
    public function delete($id);

}