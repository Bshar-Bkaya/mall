<?php

namespace App\Repository\Interfaces;


interface DepartmentRepoInterface
{
  // Insert Department
  public function insert($request);
  // Update Department
  public function update($departmentId,$request);
  // Get All Departments
  public function getDepartments();
  // Get Department By Id
  public function getDepartment($departmentId);
  // Delete Department
  public function delete($departmentId);
}
