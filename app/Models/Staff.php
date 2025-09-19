<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $table = 'staff';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];
}
