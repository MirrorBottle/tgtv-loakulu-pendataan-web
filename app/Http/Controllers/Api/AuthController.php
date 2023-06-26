<?php

namespace App\Http\Controllers\Api;

// * OTHERS
use App\Http\Controllers\Controller;
use App\Helper\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// * MODELS
use App\Models\User;
// * RESOURCES
use App\Http\Resources\Mobile\UserResource;

class AuthController extends Controller
{

  public function login(Request $request)
  {
    $credentials = $request->only('username', 'password');
    if (!Auth::guard('api')->attempt($credentials)) {
      return response()->json(new JsonResponse([], 'login_error'), Response::HTTP_NOT_FOUND);
    }
    $user = Auth::guard('api')->user();
    $cur_user = User::find($user->id);
    $cur_user->update(['device_token' => $request->has('token') ? $request->token : null]);
    $token = Auth::guard('api')->attempt($credentials);
    $data = (new UserResource($user))->token($token);
    return response()->json(new JsonResponse($data), Response::HTTP_OK);
  }

  public function info($id)
  {
    $user = User::find($id);
    return response()->json(new JsonResponse(new UserResource($user)), Response::HTTP_OK);
  }

  public function maintenance()
  {
    return response()->json(new JsonResponse([
      'status' => false,
      'message' => '-'
    ]), Response::HTTP_OK);
  }

  public function changePassword(Request $request, $id) {
    $user = User::find($id);
    if($user && Hash::check($request->oldPassword, $user->password)) {
        $user->update([
            'password' => Hash::make($request->newPassword)
        ]);
        return response()->json(new JsonResponse([]), Response::HTTP_OK);
    }
    return response()->json(new JsonResponse([]), Response::HTTP_NOT_ACCEPTABLE);
  }
}
