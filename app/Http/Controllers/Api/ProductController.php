<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
  use GeneralTrait;

  public function insert(Request $request)
  {
    try {
      $product_photo = '';
      if ($request->hasFile('photo')) {
        $product_photo = $this->uploadFile($request->file('photo'), 'product');
      }

      Product::create([
        "name"                 => $request->name,
        "description"          => $request->description,
        "manufacture_company"  => $request->manufacture_company,
        "photo"                => $product_photo,
      ]);
      return $this->returnSuccessMessage('inserted successfully');
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function update($productId, Request $request)
  {
    try {
      $product = Product::find($productId);
      if ($product) {
        $product->update([
          "name"                 => $request->name,
          "description"          => $request->description,
          "manufacture_company"  => $request->manufacture_company,
        ]);

        return $this->returnSuccessMessage('update product successfully');
      } else {
        return $this->returnError(201, 'product not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }

  public function getProducts()
  {
    try {
      $products = Product::with('vendors')->get();
      if (!$products->isEmpty()) {
        return $this->returnData('data', $products, 'get all products');
      } else {
        return $this->returnError(404, 'no products yet');
      }
    } catch (\Exception $e) {
      return $this->returnError(200, $e->getMessage());
    }
  }

  public function getProduct($productId)
  {
    $product = Product::find($productId);
    if ($product) {
      return $this->returnData('data', $product, 'get product');
    } else {
      return $this->returnError(404, 'product not found !');
    }
  }

  public function delete($productId)
  {
    try {
      $product = Product::find($productId);
      if ($product) {
        $product->delete();
        return $this->returnSuccessMessage('product deleted successfully');
      } else {
        return $this->returnError(404, 'product not found !');
      }
    } catch (\Exception $e) {
      return $this->returnError(201, $e->getMessage());
    }
  }
}
