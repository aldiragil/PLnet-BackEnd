<?php

namespace App\Http\Controllers;

use App\Models\MasterOdp;
use App\Http\Requests\StoreMasterOdpRequest;
use App\Http\Requests\UpdateMasterOdpRequest;

class MasterOdpController extends Controller
{
    // private $CustomerRepository, $ApiHelper, $menu = 'Pelanggan';
    
    // public function __construct(CustomerRepository $customerRepository,ApiHelper $apiHelper){
    //     $this->CustomerRepository   = $customerRepository;
    //     $this->ApiHelper            = $apiHelper;
    // }
    
    
    // public function all(){
    //     return $this->ApiHelper->return(
    //         $this->CustomerRepository->all(),
    //         'List Semua '.$this->menu
    //     );
    // }
    
    // public function create(CustomerRequest $request){
    //     return $this->ApiHelper->return(
    //         $this->CustomerRepository->create($request->validated()),
    //         'Simpan '.$this->menu
    //     );
        
    // }
    
    // public function update($id, CustomerRequest $request){
    //     return $this->ApiHelper->return(
    //         $this->CustomerRepository->update($request->validated(),$id),
    //         'Ubah '.$this->menu
    //     );
        
    // }
}
