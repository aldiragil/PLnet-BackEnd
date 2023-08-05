<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;
    
    // public function user()
    // {
    //     return $this->belongsToMany(
    //         User::class,
    //         'menu_accesses',
    //         'menu_id',
    //         'tipe_id'
    //     );
    // }
    public function access() : HasMany{
        return $this->hasMany(
            MenuAccess::class,
        );
    }
    
}
