<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicUser extends Model
{
    use HasFactory;

    protected $table = 'public_users';
    protected $primaryKey = 'public_user_id';

    protected $fillable = [
        'user_id','description'
    ];
}
