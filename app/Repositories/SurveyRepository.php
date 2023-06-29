<?php

namespace App\Repositories;

use App\Interfaces\SurveyInterface;
use App\Models\Survey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class SurveyRepository implements SurveyInterface {
    
    private $survey;
    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }
    
    public function all()
    {
        return $this->survey->all();
    }
    
    public function getBy(array $where,$search){
        $survey = $this->survey->where($where);
        if ($search) {
            $survey = $survey->where('name', 'like', '%'.$search.'%');
        }
        return $survey;
    }
    
    public function getById($id)
    {
        return $this->survey->find($id);
    }
    
    public function firsBy($where)
    {
        return $this->survey->where($where)->first();
    }
    
    public function create(array $data)
    {
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
    
    public function update(array $data, $id)
    {
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
    
    public function delete($id)
    {
        return $this->survey->destroy($id);
    }
 }