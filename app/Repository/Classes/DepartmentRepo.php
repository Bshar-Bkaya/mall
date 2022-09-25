<?php

namespace App\Repository\Classes;


use App\Models\Department;
use App\Traits\GeneralTrait;
use App\Repository\Interfaces\DepartmentRepoInterface;

class DepartmentRepo implements DepartmentRepoInterface
{
  use GeneralTrait;

  public function insert($request)
  {
    try {
      Department::create([
        "mall_id"      => $request->mall_id,
        "name"         => $request->name,
        "description"  => $request->description,
        "note"         => $request->note,
      ]);

      return $this->returnSuccessMessage('inserted successfully');
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function update($departmentId, $request)
  {
    try {
      $department = Department::find($departmentId);
      if ($department) {
        $department->update([
          "mall_id"      => $request->mall_id,
          "name"         => $request->name,
          "description"  => $request->description,
          "note"         => $request->note,
        ]);

        return $this->returnSuccessMessage('update department successfully');
      } else {
        return $this->returnError(201, 'department not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function getDepartments()
  {
    try {
      $departments = Department::with(['mall' => function ($m) {
        $m->select('id', 'name');
      }])->get();
      if (!$departments->isEmpty()) {
        return $this->returnData('data', $departments, 'get all departments');
      } else {
        return $this->returnError(404, 'no departments yet');
      }
    } catch (\Exception $e) {
      return $this->returnError(200, $e->getMessage());
    }
  }

  public function getDepartment($departmentId)
  {
    $department = Department::with('mall')->find($departmentId);
    if ($department) {
      return $this->returnData('data', $department, 'get department');
    } else {
      return $this->returnError(404, 'this department not found !');
    }
  }

  public function delete($departmentId)
  {
    try {
      $department = Department::find($departmentId);
      if ($department) {
        $department->delete();
        return $this->returnSuccessMessage('department deleted successfully');
      } else {
        return $this->returnError(404, 'this department not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }
}
