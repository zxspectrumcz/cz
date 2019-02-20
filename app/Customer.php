<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Customer extends Model
{
	protected $request;

	// function for checking if projects with some ID blongs to this customer


	public function check($pid)
	{
		$projects = $this->getAllProjects()->get();
		//print_r($projects);
		foreach ($projects as $project)
		{
			$arr[] = $project['id'];

		}
		if (in_array($pid, $arr))
		{
			return true;
		}
		else
		{
			return false;
		}

	}


	public function getProjects($request)
	{
		$this->request = $request;
		$return = array();

		foreach ($this->projects() as $project)
		{
			$return[$project->id] = $project->setProject();
		}
		return $return;
	}

	public function projects()
	{
		$requestData = $this->request->all();

		$langID = Input::get('langID', $requestData['lang']);
		$orderBy = Input::get('orderBy', $requestData['sorting']);
		$sortOrder = Input::get('sortOrder', $requestData['direction']);
		$limit = Input::get('limit', $requestData['limit']);
		$offset = Input::get('offset', $requestData['offset']);
		//  $langID = $requestData['lang'];
		//   $orderBy = $requestData['sorting'];
		//   $sortOrder = $requestData['direction'];
		//   $limit = $requestData['limit'];
		//   $offset = $requestData['offset'];

		$Project = new Project;
		$return = $Project->where(
			[
				['customers_id', '=', $this->user_id],
				['languages_id', '=', $langID]
			]
		)
						  ->orderBy($orderBy, $sortOrder)
						  ->limit($limit)
						  ->offset($offset)
						  ->get();
		return $return;
	}

	public function user()
	{
		// hasMany - звязок багато до багатьох    через таблицю
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

	public function getAllProjects(){
		return $this->hasMany('App\Project','customers_id','id');
	}

}