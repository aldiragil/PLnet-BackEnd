<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'code',
        'tipe_id',
        'team_id',
        'name',
        'phone',
        'email',
        'password',
        'active',
        'created_by',
        'updated_by',
    ];
    
    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
        'pivot',
        'password',
        'email_verified_at',
        'remember_token',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
    
    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }
    
    function role() {
        return $this->belongsTo(MenuRole::class,'tipe_id');
    }
    
    public function menuEmp() {
        return $this->belongsToMany(Menu::class,'menu_accesses','tipe_id')->where('menus.active',1);
    }
    
    public function workOrderEmp() {
        return $this->belongsToMany(
            WorkOrder::class,
            'work_order_emps'
        );
    }
    
    public function team(): BelongsTo {
        return $this->belongsTo(Team::class,'team_id');
    }
    
}
