<?php
namespace App\Daos;

use App\Models\UnidadModel;
use Libs\Dao;
use stdClass;

class UnidadDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }

    public function getAll(bool $estado)
    {
        $result = UnidadModel::where('Estado', $estado)->orderBy('IdUnidad', 'DESC')->get();
        return $result;
    }

    public function get(int $id)
    {
        $model = UnidadModel::find($id);

        if (is_null($model)) 
        {
            $model=new stdClass();
            $model->IdUnidad = 0;
            $model->Nombre = '';
            $model->Estado = 0;
        }
        return $model;
    }

    public function create($obj){
        
        $model = new UnidadModel();
        $model->IdUnidad = $obj->IdUnidad;
        $model->Nombre = $obj->Nombre;
        $model->Estado = $obj->Estado;
        return $model->save();
    }

    public function update($obj){
        $model = UnidadModel::find($obj->IdUnidad);
        $model->IdUnidad = $obj->IdUnidad;
        $model->Nombre = $obj->Nombre;
        $model->Estado = $obj->Estado;
        return $model->save();
    }

    public function delete(int $id){
        $model = UnidadModel::find($id);
        return $model->delete();
    }
}