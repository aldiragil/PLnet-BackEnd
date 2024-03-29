<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function survey(){
        return $this->belongsTo(Survey::class,'survey_id');
    }
}
