<?php

class Mapa
{
    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select id, 
        name, address, lat, lng, type from markers where id>1');
        $izraz->execute();
        return $izraz->fetchAll();
    }
}