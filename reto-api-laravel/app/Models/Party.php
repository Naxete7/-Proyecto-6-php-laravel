<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Party extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function game(){
        return $this ->belongsToMany(Game::class);
    }
}
