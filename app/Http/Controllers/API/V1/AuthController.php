<?php

namespace App\Http\Controllers\API\V1;

use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Http\Controllers\Controller;

/**
 * @group Auth Management
 *
 * APIs for Auth Management
 */


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','login']]);
    }

     /**
     * User Registration.
     * We dont need bearear token here.
     * @bodyParam name required string name
     * @bodyParam email required email email
     * @bodyParam password required password password
     * @response {
     *       "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNTYxNDgwOTIyLCJleHAiOjE1NjE0ODQ1MjIsIm5iZiI6MTU2MTQ4MDkyMiwianRpIjoidHZNbHgxdDBaNWdGRjRCMSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.POaqvRrqFaRjf0wrOdPprVPSuHuzlh5BnYeMI8H5-cQ",
     *       "token_type": "bearer",
     *       "expires_in": 60,
     *       "user": {
     *           "id": 1,
     *           "name": "Bijay",
     *           "email": "bj.aspire@gmail.com",
     *           "email_verified_at": null,
     *           "created_at": "2019-06-25 07:01:25",
     *           "updated_at": "2019-06-25 07:01:25"
     *       }
     *   }
     */

    public function register(Request $request)
    {
        $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => bcrypt($request->password),
         ]);
        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }

    /**
     * Get a JWT via given credentials.
     * We dont need bearear token here.
     * @bodyParam email required email email
     * @bodyParam password required password password
     * @response {
     *       "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNTYxNDgwOTIyLCJleHAiOjE1NjE0ODQ1MjIsIm5iZiI6MTU2MTQ4MDkyMiwianRpIjoidHZNbHgxdDBaNWdGRjRCMSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.POaqvRrqFaRjf0wrOdPprVPSuHuzlh5BnYeMI8H5-cQ",
     *       "token_type": "bearer",
     *       "expires_in": 60,
     *       "user": {
     *           "id": 1,
     *           "name": "Bijay",
     *           "email": "bj.aspire@gmail.com",
     *           "email_verified_at": null,
     *           "created_at": "2019-06-25 07:01:25",
     *           "updated_at": "2019-06-25 07:01:25"
     *       }
     *   }
     */

    public function login(Request $request)
    {

        $credentials = request(['email', 'password']);
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $credentialsss = $request->only('username', 'password');




        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * Get the authenticated User.
     *
     * @response{
     *       "id": 1,
     *       "name": "Bijay",
     *       "email": "bj.aspire@gmail.com",
     *       "email_verified_at": null,
     *       "created_at": "2019-06-25 07:01:25",
     *       "updated_at": "2019-06-25 07:01:25"
     *   }
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     * @response{
     *       "message": "Successfully logged out"
     *  }
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
    * @response{
    *        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvdjFcL3JlZnJlc2giLCJpYXQiOjE1NjE0ODQ2NzMsImV4cCI6MTU2MTQ4ODQ2MywibmJmIjoxNTYxNDg0ODYzLCJqdGkiOiIwT2E4b3hwTTRzTzJvUldlIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.CSG6zcN0Lvof6USFIfhP2EiYq-Pa2DfrPcwHizDrFe8",
    *        "token_type": "bearer",
    *        "expires_in": 60,
    *        "user": {
    *            "id": 1,
    *            "name": "Bijay",
    *            "email": "bj.aspire@gmail.com",
    *            "email_verified_at": null,
    *            "created_at": "2019-06-25 07:01:25",
    *            "updated_at": "2019-06-25 07:01:25"
    *        }
    *    }
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 1,
            'user' => auth('api')->user()
        ]);
    }
}
