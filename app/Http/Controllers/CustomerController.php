<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\CustomerRequest;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
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
    
    public function list(Request $request){
        $search = $request->search;
        return $this->ApiHelper->return(
            $this->CustomerRepository->getBy($search)->paginate(10),
            'Ambil Semua '.$this->menu
        );
    }
    
    
    public function create(CustomerRequest $request){
        return $this->ApiHelper->return(
            $this->CustomerRepository->create(array_merge($request->validated(),[
                "code" => $this->ApiHelper->random('CUST'),
                "created_by" => Auth::id(),
                "updated_by" => Auth::id()
            ])),
            'Simpan '.$this->menu
        );
        
    }
    
    public function update($id, CustomerRequest $request){
        return $this->ApiHelper->return(
            $this->CustomerRepository->update(array_merge($request->validated(),[
                "updated_by" => Auth::id()
            ]),$id),
            'Ubah '.$this->menu
        );
        
    }
    
}
