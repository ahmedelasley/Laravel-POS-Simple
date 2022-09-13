<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table ="suppliers";

    protected $fillable = [
        'company_name',
        'name',
        'email',
        'phone',
        'address',
        'picture',
        'status',
        'user_id',

    ];
}
