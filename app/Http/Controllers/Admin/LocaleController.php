<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Middleware\LocaleMiddleware;

class LocaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function locale($lang)
    {
        $referer = Redirect::back()->getTargetUrl();; //URL предыдущей страницы
		$parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

		//разбиваем на массив по разделителю

		
		$segments = explode('/', $parse_url);
		//dd($segments);
		//Если URL (где нажали на переключение языка) содержал корректную метку языка
		if (in_array($segments[1], LocaleMiddleware::$languages)) {
			unset($segments[1]); //удаляем метку
			session()->forget('lang');
		} 
		
		//Добавляем метку языка в URL (если выбран не язык по-умолчанию)
		session()->put('lang', $lang);
		array_splice($segments, 1, 0, session('lang'));
		//dd(session('lang'));

		//формируем полный URL
		$url = Request::root().implode("/", $segments);
		
		//если были еще GET-параметры - добавляем их
		if(parse_url($referer, PHP_URL_QUERY)){
			$url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
        }

		return $url; //Перенаправляем назад на ту же страницу    
    }

    
}
