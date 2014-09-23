<?php
include_once '../konfiguracija.php';

//ovdje definiramo vezu na bazu pomoći PHP Data Object  (http://www.php.net/manual/en/book.pdo.php)
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");
//ako je korisnik pritisnuo promjeni tada je poslana forma koja je method="POST" pa će $_POST niz biti postavljen, inače neće
if($_POST){

//prilagoditi datum
	$v = $_POST["datum"];
	$niz = explode(".", $v);
	$datum=$niz[2] . "-" . $niz[1] . "-" . $niz[0];
	$_POST["datum"]=$datum;

// prvo pripremimo upit, umjesto konkretnih vrijednosti postavljamo :kljuÄŤ koji mora odgovarati kljuÄŤu u $_POST
$izraz = $pdo->prepare("update rodjendan set slavljenik=:slavljenik, prostor=:prostor, datum=:datum, slavljenikova_godina=:slavljenikova_godina where sifra=:sifra");
//na pripremljeni upit postavljamo vrijednosti iz $_POST niza i izvodimo upit
$izraz->execute($_POST);
//Izvedeni upit je odradio update i možemo se vratiti na pregled svih autora
header("location: index.php");
print_r($_POST);
}


//ako nije postavljen $_POST onda smo došli s GET pa izvlačimo sve podatke iz tablice za autora s dobivenom šifrom
$izraz = $pdo->prepare("select * from rodjendan where sifra=:sifra");
//na pripremljeni upit postavljamo vrijednosti iz $_GET niza i izvodimo upit
$izraz->execute($_GET);
// Znako kako će upit rezultirati jednim redom iz tablice (u uvjetu je primarni ključ) varijabli $autor dodjeljujemo izvučeni objekt
$rodjendan = $izraz->fetch(PDO::FETCH_OBJ);


?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
<title><?php echo $naslov;?></title>
<?php include_once '../head.php';?>
<link rel="stylesheet" href="../css/jquery-ui.css">
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
			<label for="slavljenik">Slavljenik</label>
			<input type="text" id="slavljenik" name="slavljenik" value="<?php
			//ispisujem ime autora
			echo $rodjendan->slavljenik; ?>" />
			
			<label for="prostor">Prostor</label>
			<input type="text" id="prostor" name="prostor" value="<?php 
			//ispisujem prezime autora
			echo $rodjendan->prostor; ?>"/>
			
		    <label for="datum">Datum</label>
			<input type="text" id="datum" name="datum" value="<?php 
			//ispisujem datum rođenja
			$date = new DateTime($rodjendan->datum);
			echo $date->format('d.m.Y.'); ?>"/>
			
			<label for="slavljenikova_godina">Slavljenikova godina</label>
			<input type="text" id="slavljenikova_godina" name="slavljenikova_godina" value="<?php 
			//ispisujem prezime autora
			echo $rodjendan->slavljenikova_godina; ?>"/>
			<input type="hidden" name="sifra" value="<?php 
			// ispisujem Ĺˇifru
			//Ĺˇifru moram proslijediti preko skrivenog unosnog polja (hidden) jer nakon submit-a viĹˇe nemam Ĺˇifru u $_GET nizu veÄ‡ Ä‡e se pojaviti
			// zajedno s svim ostalim podacima u $_POST nizu
			echo $rodjendan->sifra; ?>" />
			<input type="submit" class="button" value="Promjeni" />
			</fieldset>
			</form>
			

      	</div>
      </div>
    </div>
    
    
    
    <?php include_once '../podnozje.php';?>

    
    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/foundation.min.js"></script>
	
    <script src="../js/jquery-ui.js"></script>
    
       <script>
      $(document).foundation();
      $(function(){

		$.datepicker.regional['hr'] = {
		closeText: 'Zatvori',
		prevText: 'Prethodni',
		nextText: 'Sljedeći',
		currentText: 'Trenutni',
		monthNames: ['Siječanj', 'Veljača', 'Ožujak', 'Travanj', 'Svibanj', 'Lipanj',
			'Srpanj', 'Kolovoz', 'Rujan', 'Listopad', 'Studeni', 'Prosinac'],
		monthNamesShort: ['sij', 'velj', 'ožu', 'tra', 'svi', 'lip',
			'srp', 'kol', 'ruj', 'lis', 'stu', 'pro'],
		dayNames: ['Nedjelja', 'Ponedjeljak', 'Utorak', 'Srijeda', 'Četvrtak', 'Petak', 'Subota'],
		dayNamesShort: ['ned', 'pon', 'uto', 'sri', 'čet', 'pet', 'sub'],
		dayNamesMin: ['N','P','U','S','Č','P','S'],
		weekHeader: 'Tjedan',
		dateFormat: 'dd.mm.yy.',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: '',
		changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: '1740:2020'};
	$.datepicker.setDefaults($.datepicker.regional['hr']);
	
	var datum = document.getElementById('datum').value;
    $("#datum").datepicker();
    $("#datum").val(datum);

          });
          
         
    </script>
  </body>
</html>
