<?php
//spojimo se na server i bazu s danim korisničkim imenom i lozinkom
include_once '../konfiguracija.php';

//ovdje definiramo vezu na bazu pomoći PHP Data Object  (http://www.php.net/manual/en/book.pdo.php)
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");

// prvo pripremimo upit, umjesto konkretnih vrijednosti postavljamo :ključ koji mora odgovarati ključu u $_POST
$izraz = $pdo->prepare("insert into rodjendan(slavljenik) values ('promjeni me')");
//pripremljeni upit izvedemo (ovaj puta nema vrijednosti koje treba proslijediti pa nema niti $_POST u zagradi)
$izraz->execute();
//Izvedeni upit je odradio update i možemo se vratiti na pregled svih autora
header("location: update.php?sifra=" . $pdo->lastInsertId());