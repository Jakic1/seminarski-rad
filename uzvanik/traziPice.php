<?php
//ovdje idemo u bazu

include_once '../konfiguracija.php';

//ovdje definiramo vezu na bazu pomoći PHP Data Object  (http://www.php.net/manual/en/book.pdo.php)
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");

//poslani uvjet nema znakove % pa ih dodajem
$_GET["term"] = "%" . $_GET["term"] . "%";
//Daj mi sve autore koji do sada nisu na toj knjizi
$izraz = $pdo->prepare("select * from pice where sifra not in (select autor from pice_uzvanik where uzvanik=:zapis) and (naziv like :term or vrsta like :term)");

//pripremljenom izrazu dodjelimo vrijednosti iz POST niza i izvedemo upit
$izraz->execute($_GET);


$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
//echo print_r($rezultati);
//echo print_r($_GET);
//rezultat upita vraćamo klijentu u obliku JSON-a
echo json_encode($rezultati);