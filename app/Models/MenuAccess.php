<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuAccess extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipe_id',
        'menu_id',
    ];

    public function menu():BelongsTo {
        return $this->belongsTo(Menu::class,'menu_id');
    }
    public function role():BelongsTo {
        return $this->belongsTo(Menu::class,'tipe_id');
    }

}
