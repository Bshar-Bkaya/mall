<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVendor extends Model
{
  use HasFactory;
  protected $table = "product_vendor";

  protected $fillable = [
    'product_id',
    'vendor_id',
    'price',
    'note',
  ];
}
