<?php 
include_once '../konfiguracija.php';
if(!isset($_SESSION["operater"])){
	header("Location: " . $putanja .  "index.php");
}
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


	<!--  Ovo je specifično za stranicu -->
	<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<div class="panel">
				
				<h2 class="centar">Nije moguće obrisati piće jer postoji i kod uzvanika</h2>
				
				<a href="index.php" class="button siroko">Nazad</a>

				

			</div>
		</div>
	</div>
	<!--  /Ovo je specifično za stranicu -->


	<?php include_once '../podnozje.php';?>

	<script src="<?php echo $putanja;?>js/vendor/jquery.js"></script>
	<script src="<?php echo $putanja;?>js/foundation.min.js"></script>

	<script>
      $(document).foundation();
    </script>
</body>
</html>
