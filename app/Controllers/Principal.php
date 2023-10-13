<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Principal extends BaseController
{

    public function __construct()
    {
    }
    public function index()
    {
        $data = ['titulo'=> 'Spa Paradise' ];
        echo view('/principal/header',$data);

    }

}

?>