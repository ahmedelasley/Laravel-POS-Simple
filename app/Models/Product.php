<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ="products";

    protected $fillable = [
        'barcode',
        'name',
        'description',
        'cost_price',
        'selling_price',
        'quantity',
        'picture',
        'status',
        'category_id',
        'supplier_id',
        'user_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
