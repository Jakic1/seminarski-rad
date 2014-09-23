<?php
include_once '../konfiguracija.php';

//ovdje definiramo vezu na bazu pomoći PHP Data Object  (http://www.php.net/manual/en/book.pdo.php)
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");
//ako je korisnik pritisnuo promjeni tada je poslana forma koja je method="POST" pa će $_POST niz biti postavljen, inače neće
if($_POST){
// prvo pripremimo upit, umjesto konkretnih vrijednosti postavljamo :ključ koji mora odgovarati ključu u $_POST
$izraz = $pdo->prepare("update pice set naziv=:naziv, vrsta=:vrsta where sifra=:sifra");
//na pripremljeni upit postavljamo vrijednosti iz $_POST niza i izvodimo upit
$izraz->execute($_POST);
//Izvedeni upit je odradio update i možemo se vratiti na pregled svih autora
header("location: index.php");
}

//ako nije postavljen $_POST onda smo došli s GET pa izvlačimo sve podatke iz tablice za autora s dobivenom šifrom
$izraz = $pdo->prepare("select * from pice where sifra=:sifra");
//na pripremljeni upit postavljamo vrijednosti iz $_GET niza i izvodimo upit
$izraz->execute($_GET);
// Znako kako će upit rezultirati jednim redom iz tablice (u uvjetu je primarni ključ) varijabli $autor dodjeljujemo izvučeni objekt
$pice = $izraz->fetch(PDO::FETCH_OBJ);



?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
<title><?php echo $naslov;?></title>
<?php include_once '../head.php';?>
  </head>
  <body>
  
  <?php include_once '../zaglavlje.php';?>
	<?php include_once '../izbornik.php';?>
		
    <div class="row">
      <div class="large-12 columns">
        <h1>Promjena podataka</h1>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
	        <form action="#" method="POST">
			<fieldset>
			<legend>Podaci</legend>
			<label for="naziv">Naziv</label>
			<input type="text" id="naziv" name="naziv" value="<?php
			//ispisujem ime autora
			echo $pice->naziv; ?>" />
			<label for="vrsta">Vrsta</label>
			<input type="text" id="vrsta" name="vrsta" value="<?php 
			//ispisujem prezime autora
			echo $pice->vrsta; ?>"/>
		
			<input type="hidden" name="sifra" value="<?php 
			// ispisujem šifru
			//šifru moram proslijediti preko skrivenog unosnog polja (hidden) jer nakon submit-a više nemam šifru u $_GET nizu već će se pojaviti
			// zajedno s svim ostalim podacima u $_POST nizu
			echo $pice->sifra; ?>" />
			<input type="submit" class="button" value="Promjeni" />
			</fieldset>
			</form>
			

      	</div>
      </div>
    </div>
    
    
    
    <?php include_once '../podnozje.php';?>

    
  <script src="../js/vendor/jquery.js"></script>
    <script src="../js/foundation.min.js"></script>
   
  </body>
</html>
