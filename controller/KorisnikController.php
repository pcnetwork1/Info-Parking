<?php

class KorisnikController extends Controller
{

    private $viewDir = 'privatno' . 
    DIRECTORY_SEPARATOR . 'korisnik' .
    DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
         'podaci'=>Korisnik::readAll()
     ]);
    }

    public function novi()
    {
        $this->view->render($this->viewDir . 'novi',
            ['poruka'=>'Popunite sve tražene podatke']
        );
    }

    public function dodajnovi()
    {
        //prvo dođu sve silne kontrole
        Korisnik::create();
        $this->index();
    }

   

    public function obrisi()
    {
        //prvo dođu silne kontrole
        if(Korisnik::delete()){
            header('location: /korisnik/index');
        }
        
    }

    public function promjena()
    {
        $korisnik = Korisnik::read($_GET['sifra']);
        if(!$korisnik){
            $this->index();
            exit;
        }

        $this->view->render($this->viewDir . 'promjena',
            ['korisnik'=>$korisnik,
                'poruka'=>'Promjenite željene podatke']
        );
     
    }

    public function promjeni()
    {
        // I OVDJE DOĐU SILNE KONTROLE
        korisnik::update();
        header('location: /korisnik/index');
    }
}