<?php

namespace App\Models;

use App\Models\Mall;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
  use HasFactory;
  protected $fillable = ['mall_id', 'name', 'description', 'note'];

  public function mall()
  {
    return $this->belongsTo(Mall::class, 'mall_id');
  }

  public function vendors()
  {
    return $this->belongsTo('App\Models\Vendor', 'department_id');
  }
}
