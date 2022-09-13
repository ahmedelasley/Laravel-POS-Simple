<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table ="settings";

    protected $fillable = [
        'name',
        'description',
        'email',
        'phone',
        'address',
        'type',
        'currency',
        'price',
        'quantity',
        'picture',
        'notes',
        'status',
        'user_id',

    ];
}
