<?php
namespace App\Daos;

use App\Models\ComprobanteModel;
use Libs\Dao;
use stdClass;

class ComprobanteDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }

    public function getAll()
    {
        $result = ComprobanteModel::orderBy('IdComprobante', 'DESC')->get();
        return $result;
    }

    public function get(int $id)
    {
        $model = ComprobanteModel::find($id);

        if (is_null($model)) 
        {
            $model=new stdClass();
            $model->IdComprobante = 0;
            $model->Nombre = '';
        }
        return $model;
    }

    public function create($obj){
        
        $model = new ComprobanteModel();
        $model->IdComprobante = $obj->IdComprobante;
        $model->Nombre = $obj->Nombre;
        return $model->save();
    }

    public function update($obj){
        $model = ComprobanteModel::find($obj->IdComprobante);
        $model->IdComprobante = $obj->IdComprobante;
        $model->Nombre = $obj->Nombre;
        return $model->save();
    }

    public function delete(int $id){
        $model = ComprobanteModel::find($id);
        return $model->delete();
    }

}