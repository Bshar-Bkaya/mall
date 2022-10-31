<?php


namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
  use GeneralTrait;

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'c_password' => 'required|same:password',
    ]);

    if ($validator->fails()) {
      return $this->returnError(200, $validator->errors());
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    $success['name'] =  $user->name;

    return $this->returnData('data', $success, 'User register successfully.');
  }

  public function login(Request $request)
  {
    // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //   $user = User::find(auth()->user()->id);
    //   $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //   $success['name'] =  $user->name;

    //   return $this->returnData('data', $success, 'User login successfully.');
    // } else {
    //   return $this->returnError(200, 'Unauthorised.');
    // }
    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
      return $this->returnError(200, 'Unauthorised.');
    } else {
      $success['token'] =  $user->createToken('MyApp')->plainTextToken;
      $success['name']  =  $user->name;
      return $this->returnData('data', $success, 'User login successfully.');
    }
  }
}
