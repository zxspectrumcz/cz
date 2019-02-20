<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Language;
use App\Project;
use App\ProjectParameterValue;
use App\ProjectType;
use App\Status;
use App\User;
use DB;
use Illuminate\Http\Request;
use Validator;


class ProjectController extends Controller
{
	public $rules = array(
		'project_data.name'              => 'required|min:3|max:255',
		'project_data.short_desc'        => 'required|min:3',
		'project_data.desc'              => 'required|min:3',
		'project_data.customers_id'      => 'required',
		'project_data.customers_user_id' => 'required',
		'project_data.languages_id'      => 'required',
		'project_data.tmp_type'          => 'required',
	);

	//    конструктор
	public function __construct()
	{
		//  $this->middleware('auth:api');
	}

	public function index(Request $request)
	{

	}

	public function add(Request $request)
	{
		$project_type_id = 1;
		$customers_id = 1;
		$customers_user_id = 1;
		$languages_id = 3;
		$parameters_data_tmp = array(
			1 => 'Mark Avrely',
			2 => '588',
			3 => array(2, 3),
			4 => array(4, 5, 6),
			5 => 7,
			6 => array(10, 11, 12),

		);
		$project_data_tmp = array(
			//   'name'=>'Cr',
			'name'              => 'Create empire',
			'short_desc'        => 'you have to help me create an empire',
			//   'short_desc'=>'',
			'desc'              => 'you have to help me create an empire',
			'customers_id'      => $customers_id,
			'customers_user_id' => $customers_user_id,
			'languages_id'      => $languages_id,
			'tmp_type'          => $project_type_id,
		);
		$data['project_data'] = $project_data_tmp;
		$data['parameters_data'] = $parameters_data_tmp;
		$request->merge($data);


		$ProjectTypeParameters = ProjectType::find($project_type_id)->getParameters()->get();
		// set parameters rule
		foreach ($ProjectTypeParameters as $item)
		{
			$rule_key = 'parameters_data.' . $item->id;
			if (!empty($item->element()->rule->str))
			{
				$rule_val = $item->element()->rule->str;
				$this->rules[$rule_key] = $rule_val;
			}
			if (!empty($item->rule->str))
			{

				if (isset($this->rules[$rule_key]))
				{
					$this->rules[$rule_key] = $this->rules[$rule_key] . '|' . $item->rule->str;
				}
				else
				{
					$this->rules[$rule_key] = $item->rule->str;
				}
			}
		}
		$validator = Validator::make($request->all(), $this->rules);
		// dd(app()->setLocale('ua'), $validator->getTranslator()->getLocale());
		app()->setLocale(Language::find($languages_id)->name);
		$validator->getTranslator()->getLocale();
		if ($validator->fails())
		{
			return response()->json(array('validate_errors' => $validator->errors()));

		}
		// echo 'run script'; exit();
		$Project = new Project();
		foreach ($request->project_data as $key => $value)
		{
			$Project->$key = $value;
		}
		$Project->save();
		$project_id = DB::getPdo()->lastInsertId();
		unset($Project);
		//    $project_id = 9;
		$ppv = array();
		foreach ($ProjectTypeParameters as $i)
		{
			if (isset($request->parameters_data[$i->id]))
			{
				$element = $i->element();
				$pivot_str = $element->type_value . '_value';
				$pivot_val = $request->parameters_data[$i->id];
				if ($element->type_value == 'array')
				{
					$pivot_val = json_encode($request->parameters_data[$i->id]);
				}
				$ppv[] = array(
					'project_id'   => $project_id,
					'parameter_id' => $i->id,
					$pivot_str     => $pivot_val,
				);

			}
		}
		foreach ($ppv as $items)
		{
			$tmp_ = new ProjectParameterValue;
			foreach ($items as $key => $value)
			{
				$tmp_->$key = $value;
			}
			$tmp_->save();
			unset($tmp_);
		}
		print $project_id;
		exit();
	}

	public function customer(Request $request)
	{
		$data['lang'] = 1;
		$data['limit'] = 2;
		$data['offset'] = 1;
		$data['sorting'] = 'name';
		$data['direction'] = 'desc';
		$data['filtered '] = array();  //array(parameters, project_type,)

		$request->merge($data);
		$user = Language::find(1)->get_users()->first();
		$res = $user->customer()->first()->getProjects($request);
		return response()->json($res);
	}

	public function get($project_id)
	{
		$project = Project::find($project_id);
		return response()->json($project->setProject());
	}


	public function pay(Request $request)
	{
		$project_id = trim($_POST['pid']);
		$quantity = trim($_POST['quantity']);

		$user = Language::find(1)->get_users()->first(); // +
		$customer = $user->customer;

		if ($customer->check($project_id))
		{
			foreach ($customer->user()->get()->first()->roles()->get() as $role)
			{
				foreach($role->perm()->get() as $permission)
				{
					return response()->json($permission);
				}
			}
			return response()->json();
		}
		else
		{
			$data = array(

				'status'     => "ERROR",
				'error_text' => __('projects.not_allowed')


			);
			return response()->json($data);
		}
		return response()->json();


	}
}