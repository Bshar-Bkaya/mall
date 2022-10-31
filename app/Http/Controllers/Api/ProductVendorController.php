<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\ProductVendor;
use App\Http\Controllers\Controller;

class ProductVendorController extends Controller
{
  use GeneralTrait;

  public function insert(Request $request)
  {
    try {
      ProductVendor::create([
        "product_id"   => $request->product_id,
        "vendor_id"    => $request->vendor_id,
        "price"        => $request->price,
        "note"         => $request->note,
      ]);

      // $ProductVendor = Product::find($request->product_id)->vendors()->attach($request->vendor_id);

      return $this->returnSuccessMessage('vendor sale product successfully');
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }
}
