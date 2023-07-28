<?php

namespace App\Repositories;

use App\Interfaces\InstalationInterface;
use App\Models\Instalation;
use App\Models\InstalationImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class InstalationRepository implements InstalationInterface {
    
    private $instalation,$image;
    public function __construct(Instalation $instalation,InstalationImage $image) {
        $this->instalation = $instalation;
        $this->image = $image;
    }
    
    public function getBy(array $where,$search) {
        $instalation = $this->instalation
        ->with(['work_order','customer','package','due_date','due_date.time','odp','images'])
        ->where($where);
        if ($search) {
            $instalation = $instalation->where(function($query) use($search){
                $query->where('id', 'like', '%'.$search.'%');
                $query->orWhere('code', 'like', '%'.$search.'%');
                $query->orWhereHas('work_order', function($query) use($search){
                    $query->where('name', 'like', '%'.$search.'%');
                });
                $query->orWhereHas('customer', function($query) use($search){
                    $query->where('name', 'like', '%'.$search.'%');
                });
                $query->orWhereHas('package', function($query) use($search){
                    $query->where('name', 'like', '%'.$search.'%');
                });
                $query->orWhereHas('odp', function($query) use($search){
                    $query->where('name', 'like', '%'.$search.'%');
                });
            });
        }
        return $instalation;
    }
    
    public function getById($id) {
        return $this->instalation->with(['work_order','customer','package','due_date','due_date.time','odp','images'])->find($id);
    }
    
    public function create(array $data) {
        try {
            DB::beginTransaction();
            $data = $this->instalation->create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $data = $e->getMessage();
        }
        return $data;
    }
    
    public function update(array $data, $id)
    {
        $data['updated_by'] = Auth::id();
        try {
            DB::beginTransaction();
            $response = $this->instalation->where('id', $id)->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        return $response;
    }
    
    public function delete($id)
    {
        return $this->instalation->destroy($id);
    }
    
    public function deleteImage($id) {
        return $this->image->where('instalation_id',$id)->delete();
    }
    
}