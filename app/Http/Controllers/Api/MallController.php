<?php

namespace App\Http\Controllers\Api;

use App\Models\Mall;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MallController extends Controller
{
  use GeneralTrait;

  public function insert(Request $request)
  {
    try {
      $mall_photo = '';
      if ($request->hasFile('photo')) {
        $mall_photo = $this->uploadFile($request->file('photo'), 'mall');
      }

      Mall::create([
        "manager_id"   => $request->manager_id,
        "name"         => $request->name,
        "address"      => $request->address,
        "phone"        => $request->phone,
        "space"        => $request->space,
        "rote"         => $request->rote,
        "photo"        => $mall_photo,
      ]);

      return $this->returnSuccessMessage('inserted successfully');
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function update($mallId, Request $request)
  {
    try {
      $mall = Mall::find($mallId);
      if ($mall) {
        $mall->update([
          "manager_id"   => $request->manager_id,
          "name"         => $request->name,
          "address"      => $request->address,
          "phone"        => $request->phone,
          "space"        => $request->space,
          "rote"         => $request->rote,
        ]);

        return $this->returnSuccessMessage('update mall successfully');
      } else {
        return $this->returnError(201, 'mall not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function getMalls()
  {
    try {
      $malls = Mall::all();
      if (!$malls->isEmpty()) {
        return $this->returnData('data', $malls, 'get all malls');
      } else {
        return $this->returnError(404, 'no malls yet');
      }
    } catch (\Exception $e) {
      return $this->returnError(200, $e->getMessage());
    }
  }

  public function getMall($mallId)
  {
    try {
      $mall = Mall::with('manager')->find($mallId);
      if ($mall) {
        return $this->returnData('data', $mall, 'get mall');
      } else {
        return $this->returnError(404, 'this mall not found');
      }
    } catch (\Exception $e) {
      return $this->returnError(200, $e->getMessage());
    }
  }

  public function delete($mallId)
  {
    try {
      $mall = Mall::find($mallId);
      if ($mall) {
        $mall->delete();
        return $this->returnSuccessMessage('mall deleted successfully');
      } else {
        return $this->returnError(404, 'mall not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }
}
