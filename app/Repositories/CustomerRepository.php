<?php

namespace App\Repositories;

use App\Interfaces\CustomerInterface;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class CustomerRepository implements CustomerInterface {
    
    private $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    
    public function all()
    {
        return $this->customer->all();
    }
    
    public function getBy($search){
        $customer = $this->customer->with(['user','group','payment']);
        if ($search) {
            $customer->where( function($query) use($search){
                $query->where('code', 'like', '%'.$search.'%')
                ->orWhere('nik', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%')
                ->orWhere('location', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%');
            });
        }
        return $customer->orderBy('name');
    }
    
    public function getById($id)
    {
        return $this->customer->with(['user','group','payment'])->find($id);
    }
    
    public function firsBy($where)
    {
        return $this->customer->with(['user','group','payment'])->where($where)->first();
    }
    
    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $data = $this->customer->create($data);
            DB::commit();
            return $data;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function update(array $data, $id)
    {
        $data['updated_by'] = Auth::id();
        try {
            DB::beginTransaction();
            $response = $this->customer->where('id', $id)->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        return $response;
    }
    
    public function delete($id)
    {
        return $this->customer->destroy($id);
    }
 }