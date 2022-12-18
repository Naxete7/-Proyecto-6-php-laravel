<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Message extends Model
{
    protected $fillable = [
        'message',
        'partiesId',
        'userId',

    ];

    use HasFactory, HasApiTokens, Notifiable;
}
