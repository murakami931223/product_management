<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Company extends Model
{
    protected $fillable = [
        'company_name', 
        'street_address', 
        'representative_name', 
    ];

    // ①Productモデルとの紐付け
    public function product() {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }
}
