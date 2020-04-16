<?php

class NP
{
    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select sifra, 
        name, address, type, lat, Operater, lng from markers where sifra>1');
        $izraz->execute();
        return $izraz->fetchAll();
    }
}