<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Country;
use App\Language;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {

        dd("fdfdfd");
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lang = Language::where('name', '=', $request['lang'])->first();
        $users = User::where('languages_id', '=', $lang->id)->orderBy("id")->paginate(5);
        return response()->json($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();

        // Підгружає інфу з БД із звязаних таблиць
        if($user) { 
            $user->load('country');
        }

        $countries = Country::all();
        $languages = Language::all();


        return ['user' => $user, 'countries' => $countries, 'languages' => $languages];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        // if(Gate::denies('edit', $article)) {
        //     abort(403);
        // }

        $user = User::where('id', $id)->first();

        $data = $request->all();

		if(empty($data)) {
			return array('error' => 'Нет данних');
		}

		// // провіряєм чи співпадає запис з псевдонімом тому псевдоніму який ми вводимо 
		// if(isset($result->id) && $result->id != $article->id) {

		// 	// перевірка по псевдоніму, якщо вже такий викристовується то буде помилка
		// 	$request->merge(array('alias' => $data['alias']));
		// 	// дані будуть доступні лише на наступеому завантажені а далі видалені
		// 	$request->flash();

		// 	return ['error' => 'Даний псевдонім вже використовується'];
        // }
        
        // $data['password'] => Hash::make($data['password']),
        $data['password'] = Hash::make($data['password']);

        $user->fill($data);
            
		if($user->update()) {
			return $request->all();
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if($user->delete()) {
            return ['status' => 'User Removed'];
        }
    }
}
