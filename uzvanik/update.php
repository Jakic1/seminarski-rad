<?php
include_once '../konfiguracija.php';

//ovdje definiramo vezu na bazu pomoći PHP Data Object  (http://www.php.net/manual/en/book.pdo.php)
$pdo=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$pdo->exec("set names utf8;");
//ako je korisnik pritisnuo promjeni tada je poslana forma koja je method="POST" pa će $_POST niz biti postavljen, inače neće
if($_POST){
// prvo pripremimo upit, umjesto konkretnih vrijednosti postavljamo :ključ koji mora odgovarati ključu u $_POST
$izraz = $pdo->prepare("update uzvanik set ime=:ime, prezime=:prezime, dob=:dob, rodjendan=:rodjendan where sifra=:sifra");
//na pripremljeni upit postavljamo vrijednosti iz $_POST niza i izvodimo upit
$izraz->execute($_POST);
//Izvedeni upit je odradio update i možemo se vratiti na pregled svih autora
header("location: index.php");
}

//ako nije postavljen $_POST onda smo došli s GET pa izvlačimo sve podatke iz tablice za autora s dobivenom šifrom
$izraz = $pdo->prepare("select * from uzvanik where sifra=:sifra");
//na pripremljeni upit postavljamo vrijednosti iz $_GET niza i izvodimo upit
$izraz->execute($_GET);
// Znako kako će upit rezultirati jednim redom iz tablice (u uvjetu je primarni ključ) varijabli $autor dodjeljujemo izvučeni objekt
$zapis = $izraz->fetch(PDO::FETCH_OBJ);



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
			<label for="ime">Ime</label>
			<input type="text" id="ime" name="ime" value="<?php
			//ispisujem ime autora
			echo $zapis->ime; ?>" />
				
			<label for="prezime">Prezime</label>
			<input type="text" id="prezime" name="prezime" value="<?php
			//ispisujem ime autora
			echo $zapis->prezime; ?>" />
			
			
			<label for="dob">Dob</label>
			<input type="text" id="dob" name="dob" value="<?php
			//ispisujem ime autora
			echo $zapis->dob; ?>" />
			
			<label for="rodjendan">Rođendan</label>
			
			<select id="rodjendan" name="rodjendan">
			
			<?php 
  			 	$izraz = $pdo->prepare("select * from rodjendan  order by slavljenik");
				$izraz->execute();
				$mjesta = $izraz->fetchAll(PDO::FETCH_OBJ);
				foreach($mjesta as $m){
					?>
					<option <?php 
					if($m->sifra==$zapis->rodjendan){
						echo " selected=\"selected\" ";
					}
					
					?> value="<?php echo $m->sifra ?>"><?php echo $m->slavljenik; ?></option>
					<?php
				}
  			 	?>
			
			</select>
			
			
			
			<label for="pice">Piće</label>
			
			<select id="pice" name="pice">
			
			<?php 
  			 	$izraz = $pdo->prepare("select * from pice order by naziv");
				$izraz->execute();
				$mjesto = $izraz->fetchAll(PDO::FETCH_OBJ);
				foreach($mjesto as $m){
					?>
					<option <?php 
					if($m->sifra==$zapis->pice){
						echo " selected=\"selected\" ";
					}
					
					?> value="<?php echo $m->sifra ?>"><?php echo $m->naziv; ?></option>
					<?php
				}
  			 	?>
			
			</select>
			
			Piće
			 <table class="siroko">
    			<thead>
    				<tr>
    					<th>Naziv</th>
    					<th>Akcija</th>
    				</tr>
    			</thead>
    			<tbody id="podaci">
    				<?php 
    				
    				$izraz = $pdo->prepare("select a.* from pice a inner join pice_uzvanik b on a.sifra=b.pice where b.pice=:sifra");

					$izraz->bindParam(':sifra', $zapis->sifra);
					$izraz->execute();
					$pice = $izraz->fetchAll(PDO::FETCH_OBJ);
    				
    				foreach ($pice as $p) {
						?>
						<tr>
							
							<td><?php echo $p -> naziv; ?></td>
							<td>
								
								 <a class="obrisi" id="<?php echo $p -> sifra; ?>" href="#">Obriši</a>
								
								
								</td>
						</tr>
						<?php
						}
    				?>
    			</tbody>
    		</table>
		
			
			
			<div class="row">
    			<div class="large-3 columns">Traži i dodaj piće</div>
    			<div class="large-9 columns"><input type="text" id="traziPice" /></div>
    		</div>
		
			<input type="hidden" name="sifra" value="<?php 
			// ispisujem šifru
			//šifru moram proslijediti preko skrivenog unosnog polja (hidden) jer nakon submit-a više nemam šifru u $_GET nizu već će se pojaviti
			// zajedno s svim ostalim podacima u $_POST nizu
			echo $zapis->sifra; ?>" />
			<input type="submit" class="button siroko" value="Promjeni" />
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
  $(function() {
  	
  	
  	


  	$("#traziPice").autocomplete({
  	    source: "traziPice.php?zapis=<?php echo $zapis->sifra; ?>",
  	    minLength: 1,
  	    focus: function( event, ui ) {
  	    	event.preventDefault();
  	    	},
  	    select: function(event, ui) {
  	        $(this).val('').blur();
  	        event.preventDefault();
  	        spremiUBazu(ui.item);
  			
  	    }
  		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  	      return $( "<li>" )
  	        .append( "<a>" + item.pice + "</a>" )
  	        .appendTo( ul );
  	    };
  	    

  });


  function spremiUBazu(item){
	  	//alert("Spremam u bazu " + item.rodjendan);
	  	$.ajax({
					type: "POST",
					url: "dodajPiceNaZapis.php",
					data: "zapis=<?php echo $zapis->sifra; ?>&pice=" + item.sifra,
					success: function(vratioServer){
						if(vratioServer=="OK"){
							//dodaj u tablicu
							//alert("dodajem u tablicu " + item.slavljenik);
							
							$("#podaci").append("<tr>" + 
							"<td>" + item.pice + "</td>" +
							"<td><a class=\"obrisi\" id=\"" + item.id + "\" href=\"\">Obriši</a></td></tr>"
							);
							definirajBrisanje();
						}
					}
					
				});
	  }

  function definirajBrisanje(){
	  $(".obrisi").click(function(){
	  		var element = $(this);
	  		$.ajax({
					type: "POST",
					url: "brisanjePicaSZapisa.php",
					data: "zapis=<?php echo 	$zapis->sifra; ?>&pice=" + element.attr("id"),
					success: function(vratioServer){
						if(vratioServer=="OK"){
							//dodaj u tablicu
							element.parent().parent().remove();
							//alert("obrisao" + element.attr("id"))
						}
					}
					
				});
	  		return false;
	  	});
  }


  definirajBrisanje();
  
  </script>
   	
  </body>
</html>
