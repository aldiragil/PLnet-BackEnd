<?php

namespace App\Repositories;

use App\Interfaces\SurveyInterface;
use App\Models\Survey;
use App\Models\SurveyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class SurveyRepository implements SurveyInterface {
    
    private $survey,$image;
    public function __construct(Survey $survey,SurveyImage $image){
        $this->survey = $survey;
        $this->image = $image;
    }
    
    public function all(){
        return $this->survey->all();
    }
    
    public function getBy(array $where,$search){
        $survey = $this->survey->with(['image'])->where($where);
        return $survey;
    }
    
    public function getById($id){
        return $this->survey->with(['image'])->with(['image'])->where('id',$id)->first();
    }
    
    public function firsBy($where){
        return $this->survey->with(['image'])->where($where)->first();
    }
    
    public function create(array $data){
        try {
            DB::beginTransaction();
            $data = $this->survey->create($data);
            DB::commit();
            return $data;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function update(array $data, $id){
        $data['updated_by'] = Auth::id();
        try {
            DB::beginTransaction();
            $response = $this->survey->where('id', $id)->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        return $response;
    }
    
    public function delete($id){
        return $this->survey->destroy($id);
    }

    public function deleteImage($id){
        return $this->image->where('survey_id',$id)->delete();
    }
 }