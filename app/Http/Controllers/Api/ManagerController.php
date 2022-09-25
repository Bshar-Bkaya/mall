<?php

namespace App\Http\Controllers\Api;

use App\Models\Manager;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponseResource;

class ManagerController extends Controller
{
  use GeneralTrait;

  public function insert(Request $request)
  {
    try {
      $manager_photo = '';
      if ($request->hasFile('photo')) {
        $manager_photo = $this->uploadFile($request->file('photo'), 'manager');
      }

      Manager::create([
        "name"     => $request->name,
        "email"    => $request->email,
        "phone"    => $request->phone,
        "password" => bcrypt($request->password),
        "address"  => $request->address,
        "gender"   => $request->gender,
        "photo"    => $manager_photo,
      ]);

      return $this->returnSuccessMessage('inserted successfully');
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function update($managerId, Request $request)
  {
    try {
      $manager = Manager::find($managerId);
      if ($manager) {
        $manager->update([
          "name"     => $request->name,
          "email"    => $request->email,
          "phone"    => $request->phone,
          "password" => bcrypt($request->password),
          "address"  => $request->address,
          "gender"  => $request->gender,
        ]);

        return $this->returnSuccessMessage('update manager successfully');
      } else {
        return $this->returnError(201, 'manager not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function getManagers()
  {
    try {
      $managers = Manager::with('malls')->get();
      if (!$managers->isEmpty()) {
        return $this->returnData('data', ApiResponseResource::collection($managers), 'get all managers');
      } else {
        return $this->returnError(404, 'no managers yet');
      }
    } catch (\Exception $e) {
      return $this->returnError(200, $e->getMessage());
    }
  }

  public function getManager($managerId)
  {
    $manager = Manager::with('malls')->find($managerId);
    if ($manager) {
      return $this->returnData('data', new ApiResponseResource($manager), 'get manager');
    } else {
      return $this->returnError(404, 'manager not found !');
    }
  }

  public function delete($managerId)
  {
    try {
      $manager = Manager::find($managerId);
      if ($manager) {
        $manager->delete();
        return $this->returnSuccessMessage('manager deleted successfully');
      } else {
        return $this->returnError(404, 'manager not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }
}
