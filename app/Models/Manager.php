<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'email', 'phone', 'password', 'address', 'photo'];

  public function getPhotoAttribute($value)
  {
    $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    return ($value == null ? '' : $actual_link . $value);
  }

  public function malls()
  {
    return $this->hasmany('App\Models\Mall', 'manager_id');
  }
}
