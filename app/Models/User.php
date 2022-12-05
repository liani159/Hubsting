<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Obj;
use App\Models\Folder;
use App\Models\Files;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //si esegue quando è creato un nuovo utente
    public static function booted(){

        static::created(function ($user){
            $obj = $user->objs()->make(['parent_id' => null]);
            $obj->objectable()->associate($user->folder()->create(['name' => $user->name]));
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
}
