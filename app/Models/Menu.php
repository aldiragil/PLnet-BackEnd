<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsToMany(
            User::class,
            'menu_accesses',
            'menu_id',
            'tipe_id'
        );
    }
    
}
