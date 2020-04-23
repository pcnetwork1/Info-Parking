<?php

class NadzornaplocaController extends Controller
{
    
    private $viewDir = 'privatno' .
    DIRECTORY_SEPARATOR . 'nadzornaPloca' . DIRECTORY_SEPARATOR;


    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
         'podaci'=>NP::readAll()
     ]);
    }

    public function Profil()
    {
        $this->view->render($this->viewDir . 'Profil', [
            'podaci'=>Profil::readAll()

        ]);
    }
}