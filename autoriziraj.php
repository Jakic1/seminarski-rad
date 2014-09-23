<?php
if(!isset($_POST['email']) && !isset($_POST['lozinka'])){
	echo "NE";
	exit;
}

//provjera u bazu
include_once 'konfiguracija.php';

$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");
$izraz=$pdo->prepare("select * from operater where email=:email and lozinka=:lozinka");
$izraz->bindValue(":email", $_POST['email']); 
$izraz->bindValue(":lozinka", md5($_POST['lozinka']));
$izraz->execute();
$operater=$izraz->fetch(PDO::FETCH_OBJ);
if($operater!=null){
	$_SESSION['operater']=$operater;
	echo "DA";
}
else{
	echo "NE";
}
	