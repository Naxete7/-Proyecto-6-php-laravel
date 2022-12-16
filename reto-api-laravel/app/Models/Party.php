<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Party extends Model
{
    protected $fillable = [
        'title',
        'gameId',
      
    ];

    use HasFactory, HasApiTokens, Notifiable;

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function game(){
        return $this ->belongsToMany(Game::class);
    }
}
