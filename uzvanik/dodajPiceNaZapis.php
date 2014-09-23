<?php
//ovdje idemo u bazu

include_once '../konfiguracija.php';

//ovdje definiramo vezu na bazu pomoći PHP Data Object  (http://www.php.net/manual/en/book.pdo.php)
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");

$izraz = $pdo->prepare("insert into pice_uzvanik (pice,uzvanik) values (:zapis,:pice);");

//pripremljenom izrazu dodjelimo vrijednosti iz POST niza i izvedemo upit
$izraz->execute($_POST);



echo "OK";