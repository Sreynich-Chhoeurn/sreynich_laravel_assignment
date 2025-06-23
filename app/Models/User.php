<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Attributes that can be mass assigned
    protected $table = 'usersTable'; // Ensure this matches your migration table name
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];


 
}
