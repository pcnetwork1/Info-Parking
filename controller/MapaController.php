<?php

class MapaController extends Controller
{

    private $viewDir = 'privatno' . 
    DIRECTORY_SEPARATOR . 'mapa' .
    DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render('privatno' . DIRECTORY_SEPARATOR . 'mapa' . DIRECTORY_SEPARATOR . 'index',[
            'podaci'=>Mapa::readAll()
        ]);
    }
}
