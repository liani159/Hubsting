<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Obj;
use App\Models\Folder;
use App\Models\Files;


class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id',
    ];
    protected $casts = [
        'created_at'  => 'date:d/m/Y',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public static function booted(){
        
        //creamo un oggetto che sara legato al folder radice di ciascun nuovo user
    static::created(function ($team){
        $obj = $team->objs()->make(['parent_id' => null]);
        $obj->objectable()->associate($team->folder()->create(['name' => $team->name, 
    'team_id' => $team->id ]));
        $obj->save();
        });
    }

    public function objs(){
        return $this->hasMany(Obj::class);
    }

    public function folder(){
        return $this->hasMany(Folder::class);
    }

    public function files(){
        return $this->hasMany(Files::class);
    }

    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    
}
