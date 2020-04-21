<?php

class Profil
{
    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select sifra, 
        sifra, email, lozinka, ime, prezime, uloga, aktivan from Korisnik where sifra=sifra');
        $izraz->execute();
        return $izraz->fetchAll();
    }
}