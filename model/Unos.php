<?php

class Unos
{
    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select id, 
        name, address, type, lat, lng from markers where id>1');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($id)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select id, 
        name, address, type, lat, lng from markers
        where id=:id');
        $izraz->execute(['id'=>$id]);
        return $izraz->fetch();
    }

    public static function create()
    {
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('inslat, lng) values 
        (:name,:address,:type,:lat,:lng)');
        $izraz->execute($_POST);
    }
}
