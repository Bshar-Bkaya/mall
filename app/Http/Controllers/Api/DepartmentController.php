<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\DepartmentRepoInterface;

class DepartmentController extends Controller
{

  protected $department;
  public function __construct(DepartmentRepoInterface $department)
  {
    $this->department = $department;
  }

  public function insert(Request $request)
  {
    return $this->department->insert($request);
  }

  public function update($departmentId, Request $request)
  {
    return $this->department->update($departmentId, $request);
  }

  public function getDepartments()
  {
    return $this->department->getDepartments();
  }

  public function getDepartment($departmentId)
  {
    return $this->department->getDepartment($departmentId);
  }

  public function delete($departmentId)
  {
    return $this->department->delete($departmentId);
  }
}
