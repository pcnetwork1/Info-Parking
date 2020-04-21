<?php

class Korisnik
{
    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select sifra, 
        ime, prezime, uloga, email, aktivan from korisnik where sifra>1');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select sifra, 
        ime, prezime, uloga, email from korisnik
        where sifra=:sifra');
        $izraz->execute(['sifra'=>$sifra]);
        return $izraz->fetch();
    }

    public static function create()
    {
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('insert into Korisnik
        (email,lozinka,ime,prezime,uloga) values 
        (:email,:lozinka,:ime,:prezime,:uloga)');
        unset($_POST['lozinkaponovo']);
        $_POST['lozinka'] = 
             password_hash($_POST['lozinka'],PASSWORD_BCRYPT);
        $izraz->execute($_POST);
    }


    //nije osnovno - Anita ovo ne trebaš u prvom laufu učiti
    public static function registrirajnovi()
    {
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('insert into Korisnik 
        (email,lozinka,ime,prezime,uloga,aktivan,sessionid) values 
        (:email,:lozinka,:ime,:prezime,:uloga,true,:sessionid)');
        unset($_POST['lozinkaponovo']);

        $_POST['lozinka'] = 
             password_hash($_POST['lozinka'],PASSWORD_BCRYPT);
        $_POST['sessionid'] = session_id();
        $_POST['uloga'] = 'Korisnik';
        //print_r($_POST);
        $izraz->execute($_POST);

    }

    public static function delete()
    {
        try{
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('delete from korisnik where sifra=:sifra');
            $izraz->execute($_GET);
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public static function update(){
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('update korisnik 
        set email=:email,ime=:ime,
        prezime=:prezime,uloga=:uloga where sifra=:sifra');
        $izraz->execute($_POST);
    }

    //nije osnovno - Anita ovo ne trebaš u prvom laufu učiti
    public static function zavrsiregistraciju($id){
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('update korisnik 
        set aktivan=true where sessionid=:sessionid');
        $izraz->execute(['sessionid'=>$id]);
    }
}