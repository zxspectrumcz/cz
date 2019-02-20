<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parameter;

class Project extends Model
{

    public $timestamps = false;
    public $ParemeterHasArrIDs = array(
                                'radio',
                                'select',
                                'checkbox',
                                'multiselect',
                            );
    protected $fillable = ['name','short_desc','desc','customers_id','customers_user_id','languages_id','tmp_type'];
    public function getParametersValues()
    {
        $ParametersValues = array();
        foreach ($this->getParameters() as $param){
            $element = $param->element();
            $pivot_str =  $element->type_value.'_value';
            $ParameterVal = $param->pivot->$pivot_str;
            if ($element->type_value=='id')
            {
                $ParameterVal = json_encode(array($ParameterVal));

            }
            if(array_search($element->type,$this->ParemeterHasArrIDs)!==false){
                $ParameterVal = json_decode($ParameterVal,true);
                $tmp_value_names = array();
                foreach ($param->values as $value) {
                    if (array_search($value->id, $ParameterVal) !== false) {
                        $tmp_value_names[] = $value->name;

                    }
                }
                $tmpParam = array(
                    'name'=>$param->label,
                    'value'=>implode(",",$tmp_value_names)
                );
            }else{
                $tmpParam = array(
                    'name'=>$param->label,
                    'value'=>$ParameterVal
                );
            }
            $ParametersValues[] = $tmpParam;
        }
        return $ParametersValues;

    }
    public function getTarif()
    {
        $return = array(

                'parameters_values'=>array(
                    'name'=>array(),
                    'price'=>0,
                ),
                'project_types'=>array(
                    'name'=>$this->type()->name,
                    'price'=>$this->type()->price,
                ),

        );
        foreach ($this->getParameters() as $param){
            $element = $param->element();
            $pivot_str =  $element->type_value.'_value';
            $ParameterVal = $param->pivot->$pivot_str;
            if ($element->type_value=='id')
            {
                $ParameterVal = json_encode(array($ParameterVal));

            }
            if(array_search($element->type,$this->ParemeterHasArrIDs)!==false){
                $ParameterVal = json_decode($ParameterVal,true);
                $tmp_value_names = array();
                foreach ($param->values as $value) {
                    if (array_search($value->id, $ParameterVal) !== false) {
                        $tmp_value_names[] = $value->name;
                        $return['parameters_values']['price']+= $value->price;
                    }
                }
                $return['parameters_values']['name'][]=$param->label.':('.implode(",",$tmp_value_names).')';
            }
        }
        if(count($return['parameters_values']['name']))
        {
            $return['parameters_values']['name'] = implode("+",$return['parameters_values']['name']);
        }
        return $return;
    }
    public function getParameters()
    {

        $params =  $this->belongsToMany('App\Parameter', 'projects_parameters_values')
            ->withPivot(
                'id_value',
                'varchar_value',
                'text_value',
                'array_value',
                'multifile_value'
                )
            ->get();

        return $params;
    }
    public function type()
    {
        return ProjectType::find($this->tmp_type);
    }
    public function setProject()
    {
        $return = array();
        $return['id']                   = $this->id;
        $return['title']                = $this->name;
        $return['shortDescription']     = $this->short_desc;
        $return['description']          = $this->desc;
        $return['parameters_values']    = $this->getParametersValues();
        $return['tarif']                = $this->getTarif();
        $return['status']               = array();
        $return['language']             = $this->languages_id;
        $return['createdDate']          = $this->date;
        $return['type']                 = $this->tmp_type;
        $return['groupName']            = $this->type()->name;
        $return['groupTitle']           = null;
        $return['payed']                = 0;
        $return['checking']             = 0;
        $return['reworking']            = 0;
        $return['authors']              = 0;
        $return['completed']            = 0;

        return $return;
    }
    public  function statuses(){
        return $this->belongsToMany('App\Status','statuses_projects');
    }
}