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
}
