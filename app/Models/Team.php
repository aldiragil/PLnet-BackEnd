<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model {
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function team() {
        return $this->belongsTo(team::class,'team_id');
    }

}
