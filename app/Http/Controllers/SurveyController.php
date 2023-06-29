<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Helpers\ApiHelper;
use App\Http\Requests\SurveyRequest;
use App\Repositories\SurveyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    private $SurveyRepository, $ApiHelper, $menu = 'Survey';
    
    public function __construct(SurveyRepository $surveyRepository,ApiHelper $apiHelper){
        $this->SurveyRepository = $surveyRepository;
        $this->ApiHelper        = $apiHelper;
    }
    
    public function all(){
        return $this->ApiHelper->return(
            $this->SurveyRepository->all(),
            'List Semua '.$this->menu
        );
    }
    
    public function list(Request $request){
        $where = [];
        if ($request->customer) {
            $where['customer_id'] = $request->customer;
        }
        if ($request->odp) {
            $where['odp_id'] = $request->odp;
        }
        if ($request->package) {
            $where['package_id'] = $request->package;
        }
        $search = $request->search;
        return $this->ApiHelper->return(
            $this->SurveyRepository->getBy($where,$search)->paginate(10),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function create(SurveyRequest $request){
        return $this->ApiHelper->return(
            $this->SurveyRepository->create(array_merge($request->validated(),[
                "code" => $this->ApiHelper->random('CUST'),
                "created_by" => Auth::id(),
                "updated_by" => Auth::id()
            ])),
            'Simpan '.$this->menu
        );
    }
    
    public function update($id, SurveyRequest $request){
        $return = [];
        if ($this->SurveyRepository->update(array_merge($request->validated(),["updated_by" => Auth::id()]),$id)) {
            $return = $this->SurveyRepository->getById($id);
        }
        return $this->ApiHelper->return($return,'Ubah '.$this->menu);
    }
    
}
