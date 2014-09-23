<?php
//ovdje idemo u bazu

include_once '../konfiguracija.php';

//ovdje definiramo vezu na bazu pomoći PHP Data Object  (http://www.php.net/manual/en/book.pdo.php)
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");

//poslani uvjet nema znakove % pa ih dodajem
$_POST["ime"] = "%" . $_POST["ime"] . "%";

//pripremimo upit gdje postavimo ključeve prema sadržaju primljenog POST niza (:uvjet je ključ za dohvaćanje uvjeta iz POST niza)
$izraz = $pdo->prepare("select a.sifra, a.ime,a.prezime,a.dob,b.slavljenik as rodjendan from uzvanik a inner join rodjendan b on b.sifra=a.rodjendan where a.ime like :ime order by sifra");

//pripremljenom izrazu dodjelimo vrijednosti iz POST niza i izvedemo upit
$izraz->execute($_POST);


$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);

foreach($rezultati as $r){
	$izraz = $pdo->prepare("select b.naziv from pice_uzvanik a inner join pice b on a.pice=b.sifra where a.uzvanik=:sifrauzvanik ");
	$izraz->bindParam(":sifrauzvanik", $r->sifra);
	//pripremljenom izrazu dodjelimo vrijednosti iz POST niza i izvedemo upit
	$izraz->execute();
	$r->pice= $izraz->fetchAll(PDO::FETCH_OBJ);
 }

 
//rezultat upita vraćamo klijentu u obliku JSON-a
echo json_encode($rezultati);

