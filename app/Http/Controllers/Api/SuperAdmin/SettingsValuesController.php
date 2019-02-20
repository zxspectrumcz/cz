<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Http\Controllers\Controller;
use App\SettingsName;
use App\Language;
use App\SettingsValue;
use Image;

class SettingsValuesController extends Controller
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

        $setting = new SettingsValue;
        $data = $request->all();

		if(empty($data)) {
			return array('errors' => 'Нет данних');
        }

        if($data['filevalue']){

            $this->validate($request, [
                'filevalue' => 'image64:jpeg,jpg,png' 
            ]);
            
            $height_normale_image = SettingsName::where('name', '=', 'height_normale_image')->first()->get_one_value();
            $width_normale_image = SettingsName::where('name', '=', 'width_normale_image')->first()->get_one_value();
            $height_preview_image = SettingsName::where('name', '=', 'height_preview_image')->first()->get_one_value();
            $width_preview_image = SettingsName::where('name', '=', 'width_preview_image')->first()->get_one_value();

            $image = $request->get('filevalue');

            $name_normale = time().'_normale.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $name_preview = time().'_preview.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

            Image::make($request->get('filevalue'))->resize($height_normale_image['intvalue'], $width_normale_image['intvalue'])->save(public_path('images/').$name_normale);
            Image::make($request->get('filevalue'))->resize($height_preview_image['intvalue'], $width_preview_image['intvalue'])->save(public_path('images/').$name_preview);

            $data['filevalue'] = $name_normale;
        }

        if($setting->create($data)) {
			return response()->json(['success' => 'You have successfully uploaded an image'], 200);
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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $value = SettingsValue::where('id', '=', $id)->first();
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
        $setting = SettingsValue::where('id', '=', $id)->first();
        $data = $request->all();

		if(empty($data)) {
			return array('error' => 'Нет данних');
        }
        
        if($data['filevalue']){

            $this->validate($request, [
                'filevalue' => 'image64:jpeg,jpg,png' 
            ]);
            
            $height_normale_image = SettingsName::where('name', '=', 'height_normale_image')->first()->get_one_value();
            $width_normale_image = SettingsName::where('name', '=', 'width_normale_image')->first()->get_one_value();
            $height_preview_image = SettingsName::where('name', '=', 'height_preview_image')->first()->get_one_value();
            $width_preview_image = SettingsName::where('name', '=', 'width_preview_image')->first()->get_one_value();

            $image = $request->get('filevalue');

            $name_normale = time().'_normale.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $name_preview = time().'_preview.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

            Image::make($request->get('filevalue'))->resize($height_normale_image['intvalue'], $width_normale_image['intvalue'])->save(public_path('images/').$name_normale);
            Image::make($request->get('filevalue'))->resize($height_preview_image['intvalue'], $width_preview_image['intvalue'])->save(public_path('images/').$name_preview);

            $data['filevalue'] = $name_normale;
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
        $setting = SettingsValue::where('id', $id)->first();
        if($setting->delete()) {
            return response()->json('delete value');
        }
    }
}
