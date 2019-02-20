<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\User;
use App\Language;
use App\Country;
use App\Role;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup']]);
    }

    public function profile($login = null) {
        if ($login) {
            $user = User::all()->where('login', $login)->first();
        } else {
            $user = auth()->user();
        }

        if (!$user) {
            return response()->json(['error' => 'User not found or unauthorized'], 401);
        }

        $user->load('country', 'language', 'roles');

        return response()->json([
            'user' => $user,
            'countries' => Country::all(),
            'languages' => Language::all(),
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = Auth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch(JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $user = auth()->user();
        $user->load('country', 'language', 'roles');
        return $this->respondWithToken($token, $user);
    }


    public function signup(SignUpRequest $request)
    {
        $data = $request->except('password_confirmation');
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return $this->login($request);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Update profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request) {
        $user = auth()->user();
        $id = $request->get('id', null);

        if ($id !== $user->id) {
            return response()->json([ 'error' => 'Forbidden' ], 403);
        }

        $data = $request->except('id');

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->fill($data);
        $user->save();
        $user->load('country', 'language', 'roles');

        return response()->json([
            'user' => $user,
            'countries' => Country::all(),
            'languages' => Language::all(),
        ]);
    }

    public function refresh()
    {
        $user = auth()->user();
        $user->load('country', 'language', 'roles');
        return $this->respondWithToken(auth()->refresh(), $user);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        $user = auth()->user();

        return response()->json([
            'accessToken' => $token,
            'expiresIn' => auth()->factory()->getTTL() * 60,
            'user' => $user
        ]);
    }
}
