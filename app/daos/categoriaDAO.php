<?php
namespace App\Daos;

use App\Models\CategoriaModel;
use Libs\Dao;
use stdClass;

class CategoriaDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }

    public function getAll(bool $estado)
    {
        $result = CategoriaModel::where('Estado', $estado)->orderBy('IdCateg', 'DESC')->get();
        return $result;
    }

    public function get(int $id)
    {
        $model = CategoriaModel::find($id);

        if (is_null($model)) 
        {
            $model=new stdClass();
            $model->IdCateg = 0;
            $model->Nombre = '';
            $model->Descripcion = '';
            $model->Estado = 0;
        }
        return $model;
    }

    public function create($obj){
        
        $model = new CategoriaModel();
        $model->IdCateg = $obj->IdCateg;
        $model->Nombre = $obj->Nombre;
        $model->Descripcion = $obj->Descripcion;
        $model->Estado = $obj->Estado;
        return $model->save();
    }

    public function update($obj){
        $model = CategoriaModel::find($obj->IdCateg);
        $model->IdCateg = $obj->IdCateg;
        $model->Nombre = $obj->Nombre;
        $model->Descripcion = $obj->Descripcion;
        $model->Estado = $obj->Estado;
        return $model->save();
    }

    public function delete(int $id){
        
        $model = CategoriaModel::find($id);
        return $model->delete();
    }

    public function baja(int $id){
        
        $sql = "UPDATE categorias SET estado=false WHERE idcateg=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $id, \PDO::PARAM_INT);
        return $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
    }
}