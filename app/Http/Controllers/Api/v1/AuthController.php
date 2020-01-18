<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * @param AuthRequest $request
     * @return ResponseFactory|Response
     */
    public function login(AuthRequest $request) {

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                $user->api_token = Str::random(60);
                $user->save();
                return response(['token' => $user->api_token], 200);
            }
            return response(['message' => 'Password mismatch'], 422);
        }

        return response(['message' => 'User does not exist'], 422);
    }

    /**
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public function logout(Request $request) {

        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response(['message' => 'You have been successfully logged out!'], 200);
    }
}
