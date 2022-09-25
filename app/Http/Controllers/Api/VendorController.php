<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;

class VendorController extends Controller
{
  use GeneralTrait;

  public function insert(Request $request)
  {
    try {
      $vendor_logo = '';
      if ($request->hasFile('logo')) {
        $vendor_logo = $this->uploadFile($request->file('logo'), 'vendor');
      }

      Vendor::create([
        "department_id"  => $request->department_id,
        "name"           => $request->name,
        "phone"          => $request->phone,
        "description"    => $request->description,
        "note"           => $request->note,
        "logo"           => $vendor_logo,
      ]);
      return $this->returnSuccessMessage('inserted successfully');
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function update($vendorId, Request $request)
  {
    try {
      $vendor = Vendor::find($vendorId);
      if ($vendor) {
        $vendor->update([
          "department_id"  => $request->department_id,
          "name"           => $request->name,
          "phone"          => $request->phone,
          "description"    => $request->description,
          "note"           => $request->note,
        ]);

        return $this->returnSuccessMessage('update vendor successfully');
      } else {
        return $this->returnError(201, 'vendor not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function getVendors()
  {
    try {
      $vendors = Vendor::with(['department' => function ($department) {
        $department->select('id', 'name', 'description');
      }])->get();
      if (!$vendors->isEmpty()) {
        return $this->returnData('data', $vendors, 'get all vendors');
      } else {
        return $this->returnError(404, 'no vendors yet');
      }
    } catch (\Exception $e) {
      return $this->returnError(200, $e->getMessage());
    }
  }

  public function getVendor($vendorId)
  {
    $vendor = Vendor::with(['department' => function ($department) {
      $department->select('id', 'name', 'description');
    }])->find($vendorId);
    if ($vendor) {
      return $this->returnData('data', $vendor, 'get vendor');
    } else {
      return $this->returnError(404, 'vendor not found !');
    }
  }

  public function delete($vendorId)
  {
    try {
      $vendor = Vendor::find($vendorId);
      if ($vendor) {
        $vendor->delete();
        return $this->returnSuccessMessage('vendor deleted successfully');
      } else {
        return $this->returnError(404, 'vendor not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }
}
