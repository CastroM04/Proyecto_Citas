<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiciosModel;


class Servicios extends BaseController
{

    protected $servicios;

    public function __construct()
    {
        $this->servicios = new ServiciosModel();
    }
    public function index()
    {
        $servicios = $this->servicios->where('Estado', 1)->findAll();
        $data = ['seccion' => 'Inicio', 'servicios' => $servicios];
        echo view('/principal/header');
        echo view('/servicios/servicios', $data);
    }

    public function Eliminados()
    {
        $servicios = $this->servicios->where('Estado', 2)->findAll();
        $data = ['seccion' => 'Eliminados', 'servicios' => $servicios];
        echo view('/principal/header');
        echo view('/servicios/servicios', $data);
    }

    public function insertar()
    {

        $nombre = $this->request->getVar('DescripcionSer');

        $valor = $this->request->getVar('ValorSer');
        if ($foto = $this->request->getFile('FotoSer')) {
            $nuevo_nombre = $foto->getRandomName();
            $foto->move('../public/img/servicios', $nuevo_nombre);
        }

        $Datos = [
            'Descripcion' => $nombre,
            'valor_servicio' => $valor,
            'Imagen' => $nuevo_nombre

        ];
        $servicio = $this->servicios->insert($Datos);
        return redirect('Servicios');
    }


    public function desactivar($id, $Accion)
    {
        if($Accion ==1){
            $message = "Se activo correctamente";
        }else{
            $message = "Se desactivo correctamente";
        }
        $repuesta = $this->servicios->desactivar_Servicio($id, $Accion);
        if ($repuesta) {

           return $message;

           return redirect('Servicios');

        } else {
            return 'No se pudo modificar';
        }

    }
}