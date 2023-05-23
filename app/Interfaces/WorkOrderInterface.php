<?php

namespace App\Interfaces;

interface WorkOrderInterface
{

    public function all();
    public function getById($id);
    public function createData($data, $user_id);
    public function updateData(array $data, $user_id, $id);
    public function deleteData($id);

}