<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request) {
        $q = $request->get('q');

        if ($q) {
            $users = User::where('login', 'LIKE', '%'.$q.'%')->take(20)->get();
        } else {
            $users = User::take(20)->get();
        }

        return response()->json($users);
    }

//    +
    public function getUser(){
        $user = auth()->user();
        $user->load('roles');
        $res = array();
        $res['id'] = $user -> id;
        $res['role'] = $user -> roles[0]->id;
        return response()->json($res);
    }
}
