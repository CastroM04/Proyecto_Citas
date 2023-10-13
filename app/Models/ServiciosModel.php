<?php

namespace App\Models;

use CodeIgniter\Model;


class ServiciosModel extends Model
{

    protected $table = 'tbl_servicio';
    protected $primaryKey = 'PK_codigo_Se';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['FK_TipoServicio', 'Descripcion', 'valor_servicio', 'Imagen', 'Estado'];
    protected $useTimeStamps = false;
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = '';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;


    public function obtener_Servicio($id)
    {
        return $this->where('PK_codigo_se', $id)->first();

    }




    public function desactivar_Servicio($id, $Accion)
    {
        $data = ['Estado' => $Accion];
        $Response = $this->update($id, $data);
        if ($Response) {
            
            return true;
        }




    }
}