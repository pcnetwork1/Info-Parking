<?php

class UnosController extends Controller
{

    private $viewDir = 'privatno' . 
    DIRECTORY_SEPARATOR . 'unos' .
    DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render('privatno' . DIRECTORY_SEPARATOR . 'unos' . DIRECTORY_SEPARATOR . 'index');
    }

    public function dodajnovi()
    {
        //prvo dođu sve silne kontrole
        Unos::create();
        $this->index();
    }

   

    public function obrisi()
    {
        //prvo dođu silne kontrole
        if(Unos::delete()){
            header('location: /Unos/index');
        }
        
    }

}
