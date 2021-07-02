<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funder extends Model
{
    use HasFactory;

    protected $table = 'funders';
    protected $primaryKey = 'funders_id';

    protected $fillable = [
        'user_id', 'company_name', 'description'
    ];
}
