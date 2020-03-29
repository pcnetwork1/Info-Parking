<?php

$imeTablice='ADRESE_UPISANIH_OSOBA';
$podaci=[];

$kolone=[
    'GML_ID' => 'ADRESE_UPISANIH_OSOBA.1',
    'POSJEDNIK_ID' => '9054711',
    'DRZAVA' => 'HRVATSKA',
    'ADRESA_OPISNA' => 'NULL',
    'POSTANSKI_BROJ' => 'NULL',
    'NASELJE' => 'Gunja',
    'NASELJE_MBR' => '23060',
    'ULICA' => 'ANTE STARČEVIĆA',
    'ULICA_RBR' => '4',
    'KBR' => '104',
    'KBR_DODATAK_A' => 'B',
    'KBR_DODATAK_N' => 'NULL'
];

$podaci[] = $kolone;


$kolone=[
    'GML_ID' => 'ADRESE_UPISANIH_OSOBA.1',
    'POSJEDNIK_ID' => '2222',
    'DRZAVA' => 'HR',
    'ADRESA_OPISNA' => 'NULL',
    'POSTANSKI_BROJ' => 'NULL',
    'NASELJE' => 'Gunja',
    'NASELJE_MBR' => '23060',
    'ULICA' => 'ANTE STARČEVIĆA',
    'ULICA_RBR' => '4',
    'KBR' => '104',
    'KBR_DODATAK_A' => 'B',
    'KBR_DODATAK_N' => 'NULL'
];

$podaci[] = $kolone;

foreach($podaci as $podatak){

$sql = 'insert into ' . $imeTablice . '(';

foreach($podatak as $kljuc=>$vrijednost){
    $sql .= $kljuc . ',';
}

$sql.=') values (';

foreach($podatak as $kljuc=>$vrijednost){
    $sql .= ':' . $kljuc . ',';
}

$sql.=');';

echo $sql;

break;
}

$veza->beginTransaction();
$izraz = $veza->prepare($sql);
$b=0;
foreach($podaci as $podatak){
$izraz->execute($podatak);
if($b++ % 1000===0){
    $veza->commit();
    $veza->beginTransaction();
}
}
$veza->commit();


/*
switch ($featureName) {
    case 'ADRESE_CESTICE':
        echo '<pre style="padding-left: 50px;">';
        GmlAdreseCesticeController::echoFeatureData($featureData, $gmlIdAttribute);
        echo '</pre>';
        break;

        */

//napraviti controllere kao mi u app (ne statične funckije)
//svaku funkciju nazvati echoFeatureData s dva parametra
$imeKlase = $featureName . '_Controller';
//nazvati svaku klasu npr. ZK_VLASNICI_Controller
$instanca = new $featureName();
$instanca->echoFeatureData($featureData, $gmlIdAttribute);