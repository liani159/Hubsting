<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Obj extends Model
{
    use HasFactory;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;


    protected $fillable = [
        'parent_id',
    ];

    public function objectable(){
        return $this->morphTo();
    }

    public static function booted(){

        static::creating(function ($model){
            $model->uuid = Str::uuid();
        });
    }

    /* public function children(){
        return $this->hasMany(Obj::class, 'parent_id', 'id');
    } */

    /* public function parent(){
        return $this->belongsTo(Obj::class, 'parent_id', 'id');
    }

    public function ancestor(){
        $ancestor = $this;
        $ancestors = collect();

        while($ancestor->parent){
            $ancestor = $ancestor->parent;
            $ancestors->push($ancestor);
        }
        return $ancestors;
    } */
}
