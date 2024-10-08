<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
        'path',
    ];

    protected $casts = [
        'created_at'  => 'date:d/m/Y',
    ];

    public static function booted(){

        static::creating(function ($model){
            $model->uuid = Str::uuid();
        });

        static::deleting(function ($model){
            Storage::disk('local')->delete($model->path);
        });
    }

    public function sizeForHumans(){
        $bytes = $this->size;
        $units = ['b', 'kb', 'mb', 'gb'];

        for($i = 0; $bytes >1024; $i++){
            $bytes /= 1024 ;
        }

        return round($bytes, 2) . $units[$i];
    }

    
}
