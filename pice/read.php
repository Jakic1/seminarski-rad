<?php
//ovdje idemo u bazu

include_once '../konfiguracija.php';

//ovdje definiramo vezu na bazu pomoći PHP Data Object  (http://www.php.net/manual/en/book.pdo.php)
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");

//poslani uvjet nema znakove % pa ih dodajem
$_POST["naziv"] = "%" . $_POST["naziv"] . "%";

//pripremimo upit gdje postavimo ključeve prema sadržaju primljenog POST niza (:uvjet je ključ za dohvaćanje uvjeta iz POST niza)
$izraz = $pdo->prepare("select * from pice where naziv like :naziv");

//pripremljenom izrazu dodjelimo vrijednosti iz POST niza i izvedemo upit
$izraz->execute($_POST);

//rezultat upita vraćamo klijentu u obliku JSON-a
echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));