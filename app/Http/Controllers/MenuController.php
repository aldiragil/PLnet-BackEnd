<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Helpers\MenuHelper;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Repositories\MenuRepository;

class MenuController extends Controller
{

    private $MenuRepository,$ApiHelper;
    
    public function __construct(MenuRepository $MenuRepository,ApiHelper $ApiHelper)
    {
        $this->MenuRepository = $MenuRepository;
        $this->ApiHelper = $ApiHelper;
    }

    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        //
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        //
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(StoreMenuRequest $request)
    {
        //
    }
    
    /**
    * Display the specified resource.
    */
    public function show($id)
    {
        $data = $this->MenuRepository->show($id);
        
        if(is_array($data)){
            return $this->ApiHelper->response(200,true,CREATE_SUCCESS,$data);
        }else{
            return $this->ApiHelper->response(400,false,CREATE_FAILED,$data);
        }
    }
    
    /**
    * Show the form for editing the specified resource.
    */
    public function edit()
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Menu $menu)
    {
        //
    }
}
