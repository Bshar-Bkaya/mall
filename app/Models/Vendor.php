<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
  use HasFactory;

  protected $fillable = [
    'department_id',
    'name',
    'phone',
    'description',
    'note',
    'logo',
  ];

  public function getLogoAttribute($value)
  {
    $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    return ($value == null ? '' : $actual_link . $value);
  }

  public function department()
  {
    return $this->belongsTo('App\Models\Department', 'department_id');
  }

  public function products()
  {
    return $this->belongsToMany('App\Models\Product');
  }
}
