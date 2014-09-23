<?php
include_once '../konfiguracija.php';
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");


$izraz = $pdo->prepare("delete from pice_uzvanik where uzvanik=:zapis and pice=:pice");
$izraz->execute($_POST);

echo "OK";