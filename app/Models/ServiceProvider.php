<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $table = 'service_providers';
    protected $primaryKey = 'service_providers_id';

    protected $fillable = [
        'user_id', 'company_name', 'description'
    ];
}
