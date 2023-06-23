<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\CustomerRequest;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    private $CustomerRepository, $ApiHelper, $menu = 'Pelanggan';
    
    public function __construct(CustomerRepository $customerRepository,ApiHelper $apiHelper){
        $this->CustomerRepository   = $customerRepository;
        $this->ApiHelper            = $apiHelper;
    }
    
    
    public function all(){
        return $this->ApiHelper->return(
            $this->CustomerRepository->all(),
            'List Semua '.$this->menu
        );
    }
    
    public function create(CustomerRequest $request){
        $request['created_by'] = Auth::id();
        $request['updated_by'] = Auth::id();
         return $this->ApiHelper->return(
            $this->CustomerRepository->create($request->validated()),
            'Simpan '.$this->menu
        );
        
    }
    
    public function update($id, CustomerRequest $request){
        $request['updated_by'] = Auth::id();
        return $this->ApiHelper->return(
            $this->CustomerRepository->update($request->validated(),$id),
            'Ubah '.$this->menu
        );
        
    }
    
}
