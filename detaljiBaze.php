<?php 
include_once 'konfiguracija.php';

if(!isset($_SESSION['operater'])){
	header("location: odjava.php");	
}
?>

<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<head>
<title><?php echo $naslov;?></title>
<?php include_once 'head.php';?>
</head>
<body>
	<?php include_once 'zaglavlje.php';?>
	<?php include_once 'izbornik.php';?>
<div class="row">
	<div class="large-12 columns">
		<h3>Detalji baze</h3>
		<?php 
		include_once 'konfiguracija.php';
		$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
		$veza->exec("set names utf8;");
		
		$izraz = $veza->prepare("show tables;");
		$izraz->execute();
		$skup=$izraz->fetchALL(PDO::FETCH_BOTH);
		
		foreach($skup as $s){
			echo "<h2>" . $s[0] . "</h2>";
			$izraz = $veza->prepare("describe " . $s[0]);
			$izraz->execute();
			$skup1=$izraz->fetchALL(PDO::FETCH_BOTH);
			//print_r($skup1);
			echo("Field Type Null Key Default Extra<br />");
			foreach($skup1 as $s1){
				echo $s1[0] . " " .$s1[1] . " " .$s1[2] . " " .$s1[3] . " " .$s1[4] . " " .$s1[5] . "<br />";
		
			}
		}
		echo "<hr />";
		$izraz = $veza->prepare("select concat(table_name, '.', column_name) as 'Vanjski kljuc', concat(referenced_table_name, '.', referenced_column_name) as 'primarnji kljuc' from     information_schema.key_column_usage where referenced_table_name is not null and table_schema = '" . $baza . "';");
		$izraz->execute();
		$skup=$izraz->fetchALL(PDO::FETCH_BOTH);
		//print_r($skup);
		echo "Vanjski ključ : Primarni ključ<br />";
		foreach($skup as $s){
			echo $s[0] . " : " . $s[1] . "<br />";
		}
		
		echo "<hr />";
		$izraz = $veza->prepare("show tables;");
		$izraz->execute();
		$skup=$izraz->fetchALL(PDO::FETCH_BOTH);
		$brojAtributa=0;
		$brojZapisa=0;
		$brojNull=0;
		foreach($skup as $s){
			$izraz = $veza->prepare("describe " . $s[0]);
			$izraz->execute();
			$skup1=$izraz->fetchALL(PDO::FETCH_BOTH);
			foreach($skup1 as $s1){
				$izraz = $veza->prepare("select count(*) as ukupno from " . $s[0] . " where " . $s1[0] . " is null");
				$izraz->execute();
				$skup2=$izraz->fetchALL(PDO::FETCH_BOTH);
				foreach($skup2 as $s2){
					$brojNull=$brojNull + $s2[0];
				}
				
			$brojAtributa++;
			}
			
			$izraz = $veza->prepare("select count(*) as ukupno from " . $s[0]);
			$izraz->execute();
			$skup1=$izraz->fetchALL(PDO::FETCH_BOTH);
			foreach($skup1 as $s1){
				$brojZapisa=$brojZapisa+$s1[0];
			}
		}
		
		echo "Tablice ukupno imaju minimalno 20 atributa. (max 3 boda). Ja imam " . $brojAtributa . "<hr />";
		echo "U tablicama ukupno ima minimalno 50 zapisa. (max 3 boda). Ja imam " . $brojZapisa . "<hr />";
		echo "U zapisima je dozvoljeno ne poznavanje vrijednosti ili prazne vrijednosti (\"\") na 100 atributa. (max 2 boda). Ja imam " . $brojNull . "<hr />";
		
		?>
		
		


	</div>


</div>



<?php include 'podnozje.php';?>


<script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
  '.js><\/script>')
  </script>

<script src="js/foundation.min.js"></script>

</body>
</html>
