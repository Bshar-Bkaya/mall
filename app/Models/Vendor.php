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

  public function department(){
    return $this->belongsTo('App\Models\Department', 'department_id');
  }
}
