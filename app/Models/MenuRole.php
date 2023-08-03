<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuRole extends Model {
    use HasFactory;

    public function users():HasMany {
        return $this->hasMany(User::class);
    }

    public function accesses():HasMany {
        return $this->hasMany(MenuAccess::class);
    }

    public function menus():BelongsToMany {
        return $this->belongsToMany(Menu::class,'menu_accesses','tipe_id','menu_id')->where('menus.active',1);
    }

}
