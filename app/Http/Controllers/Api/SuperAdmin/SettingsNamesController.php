<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SettingsName;
use App\Language;
use App\SettingsValue;

class SettingsNamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

       

        $setting = new SettingsName;
        $data = $request->all();

		if(empty($data)) {
			return array('error' => 'Нет данних');
		}

		if($setting->create($data)) {
			return response()->json('add sucesses');
		}
    }

    public function settings_names(Request $request)
    {
        $lang = Language::where('name', '=', $request['lang'])->first();
        $settings_names = SettingsName::where('language_id', '=', 1)->get();
        return response()->json($settings_names);
    }


    public function settings_values(Request $request)
    {
        $settings_values = SettingsName::getAllValues($request['lang'], $request['name']);
        return response()->json($settings_values);
    }

    public function languages()
    {
        $lang = Language::all();
        return response()->json($lang);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $value = SettingsName::where('id', '=', $id)->first();
        return response()->json($value);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $setting = SettingsName::where('id', '=', $id)->first();
        $data = $request->all();

		if(empty($data)) {
			return array('error' => 'Нет данних');
		}

        $setting->fill($data);
            
		if($setting->update()) {
			return response()->json('update sucesses');
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
        $setting = SettingsName::where('id', $id)->first();
        if($setting->delete()) {
            return response()->json('delete value');
        }
    }
}
