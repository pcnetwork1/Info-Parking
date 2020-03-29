<?php

class Grupa
{
    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select a.sifra, a.naziv, b.naziv as smjer, 
            concat(d.ime, \' \', d.prezime) as predavac,
            a.datumpocetka, count(e.polaznik) as brojpolaznika
            from grupa a inner join smjer b on a.smjer=b.sifra
            left join predavac c on a.predavac=c.sifra
            left join osoba d on c.osoba=d.sifra
            left join clan e on a.sifra=e.grupa
            group by a.sifra, a.naziv, b.naziv , 
            concat(d.ime, \' \', d.prezime),
            a.datumpocetka
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select *
            from grupa 
            where sifra=:sifra

        ');
        $izraz->execute(['sifra'=>$sifra]);
        return $izraz->fetch();
    }

    public static function ucitajPolaznike($sifraGrupe)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select b.sifra,concat(c.ime, \' \', c.prezime) as imeprezime,c.oib
        from clan a inner join polaznik b
        on a.polaznik=b.sifra
        inner join osoba c
        on b.osoba=c.sifra
        where a.grupa=:sifra

        ');
        $izraz->execute(['sifra'=>$sifraGrupe]);
        return $izraz->fetchAll();
    }

    public static function create($smjer)
    {
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('insert into grupa 
        (naziv,smjer,brojpolaznika) values 
        (\'\',:smjer,0)');
        $izraz->execute(['smjer' => $smjer]);  
       return $veza->lastInsertId();

    }

    public static function delete()
    {
        try{
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('delete from grupa 
            where sifra=:sifra');
            $izraz->execute($_GET);
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public static function update(){
        if($_POST['predavac']=='0'){
            $_POST['predavac']=null;
        }
        if($_POST['datumpocetka']==''){
            $_POST['datumpocetka']=null;
        }else{
            $_POST['datumpocetka']=
            str_replace(
                'T', ' ',  $_POST['datumpocetka']
            ); 
        }
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('update grupa 
        set naziv=:naziv,smjer=:smjer,
        predavac=:predavac,
        brojpolaznika=:brojpolaznika,
        datumpocetka=:datumpocetka
         where sifra=:sifra');
        $izraz->execute($_POST);
    }
}