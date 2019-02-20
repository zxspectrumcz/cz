<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectType;
use App\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class ProjectTypeController extends Controller
{
    //    конструктор
    public function __construct()
    {
        //  $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $user = Language::find(1)->get_users()->first();

        $tmp_ = $this->getProjectTypesTree($user->language_id);
        echo '<pre>';
        print_r($tmp_);
        exit();


    }
    public  function getProjectTypesTree($lang_id)
    {
        $this->languages_id=$lang_id;
        $ret = array();
        $types =  ProjectType::where('root','1')->where('languages_id',$this->languages_id)->get();
       // $ret[] = $menus->toArray();
        foreach($types as $type){
            $childrens = $this->get_childrens($type);
            if (count($childrens)) {
                $ret[$type->id] = array_merge($type->toArray(), [
                    'subtype' => $childrens
                ]);
            } else {
                $ret[$type->id] = $type->toArray();
            }
            unset($ret[$type->id]['childrens']);
        }

        return $ret;
    }
    private function get_childrens($type){
        $ret = array();
        if (isset($type->childrens) && count($type->childrens)) {
            foreach ($type->childrens as $children) {
                $item = $children->parent;
                $subChildrens = $this->get_childrens($item);

                if (count($subChildrens)) {
                    $ret[$children->project_type_child_id] = array_merge($item->toArray(), [
                        'subtype' => $subChildrens
                    ]);
                } else {
                    $ret[$children->project_type_child_id] = $item->toArray();
                }
                unset($ret[$children->project_type_child_id]['childrens']);
            }
        }

        return $ret;
    }
    /*
     * return parameters by type id
     */
    public function parameters($type_id=null,$json=true)
    {

        $parameters = array();
        //$tmp_ = ProjectType::find($type_id)->getParameters()->get();
        $tmp_ = ProjectType::find($type_id);
        $res = array(
            'id'=>$tmp_->id,
            'name'=>$tmp_->name,
            'icon'=>$tmp_->icon,
            'price'=>$tmp_->price,
            'parameters'=>array(),
        );
         foreach($tmp_->getParameters()->get() as $i)
        {
            $parameters[$i->id]=array(
                        'id'=>$i->id,
                        'label'=>$i->label,
                        'elem_type'=>$i->element()->type,
                        'values'=>array(),
            );
            foreach($i->values as $value)
            {
                $parameters[$i->id]['values'][$value->id]=array(
                    'id'=>$value->id,
                    'name'=>$value->name,
                    'price'=>$value->price
                );

            }
        }

        $res['parameters']=$parameters;
        unset($tmp_);
        unset($parameters);
     //echo '<pre>';  print_r($res); exit();
        if($json){
            return response()->json($res);
        }else{
            return $res;
        }

      //  exit();
    }
}

?>