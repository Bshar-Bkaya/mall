<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MallController;
use App\Http\Controllers\Api\VendorController;
use App\Http\Controllers\Api\ManagerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ProductVendorController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
  // ############### Manager ###############
  Route::prefix('manager')->group(function () {
    Route::post('insert-manager', [ManagerController::class, 'insert']);
    Route::post('update-manager/{managerId?}', [ManagerController::class, 'update']);
    Route::get('get-managers', [ManagerController::class, 'getManagers']);
    Route::get('get-manager/{managerId?}', [ManagerController::class, 'getManager']);
    Route::post('delete-manager/{managerId?}', [ManagerController::class, 'delete']);
  });

// ############### Mall ###############
Route::group(['prefix' => 'mall'], function () {
  Route::post('insert-mall', [MallController::class, 'insert']);
  Route::post('update-mall/{mallId?}', [MallController::class, 'update']);
  Route::get('get-malls', [MallController::class, 'getMalls']);
  Route::get('get-mall/{mallId?}', [MallController::class, 'getMall']);
  Route::post('delete-mall/{mallId?}', [MallController::class, 'delete']);
});

// ############### Department ###############
Route::group(['prefix' => 'department'], function () {
  Route::post('insert-department', [DepartmentController::class, 'insert']);
  Route::post('update-department/{departmentId?}', [DepartmentController::class, 'update']);
  Route::get('get-departments', [DepartmentController::class, 'getDepartments']);
  Route::get('get-department/{departmentId?}', [DepartmentController::class, 'getDepartment']);
  Route::post('delete-department/{departmentId?}', [DepartmentController::class, 'delete']);
});

// ############### Vendor ###############
Route::group(['prefix' => 'vendor'], function () {
  Route::post('insert-vendor', [VendorController::class, 'insert']);
  Route::post('update-vendor/{vendorId?}', [VendorController::class, 'update']);
  Route::get('get-vendors', [VendorController::class, 'getVendors']);
  Route::get('get-vendor/{vendorId?}', [VendorController::class, 'getVendor']);
  Route::post('delete-vendor/{vendorId?}', [VendorController::class, 'delete']);
});

// ############### Product ###############
Route::group(['prefix' => 'product'], function () {
  Route::post('insert-product', [ProductController::class, 'insert']);
  Route::post('update-product/{productId?}', [ProductController::class, 'update']);
  Route::get('get-products', [ProductController::class, 'getProducts']);
  Route::get('get-product/{productId?}', [ProductController::class, 'getProduct']);
  Route::post('delete-product/{productId?}', [ProductController::class, 'delete']);
});

// ############### Product_Vendor ###############
Route::post('insert-product-vendor', [ProductVendorController::class, 'insert']);
});

// ############### User_Controller ###############
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
