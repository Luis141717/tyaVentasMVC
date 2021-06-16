<?php
namespace App\Daos;

use App\Models\FormaPagoModel;
use Libs\Dao;
use stdClass;

class FormaPagoDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }

    public function getAll()
    {
        $result = FormaPagoModel::orderBy('idformapago', 'DESC')->get();
        return $result;
    }

    public function get(int $id)
    {
        $model = FormaPagoModel::find($id);

        if (is_null($model)) 
        {
            $model=new stdClass();
            $model->IdFormaPago = 0;
            $model->Nombre = '';
        }
        return $model;
    }

    public function create($obj){
        
        $model = new FormaPagoModel();
        $model->IdFormaPago = $obj->IdFormaPago;
        $model->Nombre = $obj->Nombre;
        return $model->save();
    }

    public function update($obj){
        $model = FormaPagoModel::find($obj->IdFormaPago);
        $model->IdFormaPago = $obj->IdFormaPago;
        $model->Nombre = $obj->Nombre;
        return $model->save();
        
    }

    public function delete(int $id){
        
        $model = FormaPagoModel::find($id);
        return $model->delete();
    }

}