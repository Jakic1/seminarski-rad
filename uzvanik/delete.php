<?php
include_once '../konfiguracija.php';
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");


$izraz = $pdo->prepare("delete from pice_uzvanik where uzvanik=:sifra");
$izraz->execute($_GET);

	$izraz = $pdo->prepare("delete from uzvanik where sifra=:sifra");
	$izraz->execute($_GET);
	
	
	
	header("location: index.php");

