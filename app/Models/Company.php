<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'slug',
        'address',
        'phone',
        'webiste',
        'logo',
        'cover_photo',
        'slogan',
        'description',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function jobs() {

        return $this->hasMany(Job::class);
    }
}
