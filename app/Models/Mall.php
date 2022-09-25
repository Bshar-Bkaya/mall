<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mall extends Model
{
  use HasFactory;
  protected $fillable = [
    'manager_id',
    'name',
    'address',
    'phone',
    'space',
    'rote',
    'photo'
  ];

  public function getPhotoAttribute($value)
  {
    $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    return ($value == null ? '' : $actual_link . $value);
  }

  public function manager()
  {
    return $this->belongsTo('App\Models\Manager');
  }


  public function departments()
  {
    return $this->hasmany(Department::class, 'mall_id');
  }
}
