<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'identification',
        'address',
        'phone',
        'city_id',
        'boss_id',
        'is_president',
    ];

    /* =====================
     | Relaciones
     ===================== */

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    public function boss()
    {
        return $this->belongsTo(Employee::class, 'boss_id');
    }

    public function collaborators()
    {
        return $this->hasMany(Employee::class, 'boss_id');
    }

    /* =====================
     | Scopes
     ===================== */

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeNotPresident($query)
    {
        return $query->where('is_president', false);
    }
}
