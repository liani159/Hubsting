<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
    ];

    public static function booted(){

        static::creating(function ($model){
            $model->uuid = Str::uuid();
        });
    }
}
