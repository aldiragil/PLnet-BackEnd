<?php

namespace App\Repositories;

use App\Interfaces\MasterOdpInterface;
use App\Models\MasterOdp;
use App\Models\MasterOdpImage;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class MasterOdpRepository implements MasterOdpInterface {
    
    private $masterOdp, $image;
    public function __construct(MasterOdp $masterOdp,MasterOdpImage $image) {
        $this->masterOdp = $masterOdp;
        $this->image = $image;
    }
    
    public function all() {
        return $this->masterOdp->all();
    }
    
    public function getBy(array $where,$search) {
        $masterOdp = $this->masterOdp->with(['image','work_order']);
        if ($search) {
            $masterOdp->where(function($query) use($search) {
                $query->where('code', 'like', '%'.$search.'%');
                $query->orWhere('name', 'like', '%'.$search.'%');
                $query->orWhere('serial', 'like', '%'.$search.'%');
                $query->orWhere('location', 'like', '%'.$search.'%');
                $query->orWhere('device', 'like', '%'.$search.'%');
            });
        }
        return $masterOdp->where($where);
    }
    
    public function getById($id) {
        return $this->masterOdp->with(['image','work_order'])->where('id',$id)->first();
    }
    
    public function firsBy($where) {
        return $this->masterOdp->with(['image','work_order'])->where($where)->first();
    }
    
    public function getByDistance($wo) {
        return $this->masterOdp->selectRaw("*, ROUND(6371 * acos(cos(radians(" .$wo->latitude. "))
        * cos(radians(`latitude`))
        * cos(radians(`longitude`) - radians(" .$wo->longitude. "))
        + sin(radians(" .$wo->latitude. ")) * sin(radians(`latitude`))
    ),2) AS distance")
        ->orderBy('distance')
        ->get();
    }
    
    public function create(array $data) {
        try {
            DB::beginTransaction();
            $response = $this->masterOdp->create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        return $response;
    }
    
    public function update(array $data, $id) {
        $data['updated_by'] = Auth::id();
        try {
            DB::beginTransaction();
            $response = $this->masterOdp->where('id', $id)->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        return $response;
    }
    
    public function delete($id) {
        return $this->masterOdp->destroy($id);
    }
    
    public function deleteImage($id) {
        return $this->image->where('master_odp_id',$id)->delete();
    }
}