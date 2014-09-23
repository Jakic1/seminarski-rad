<?php 
include_once 'konfiguracija.php';
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<title><?php echo $naslov;?></title>
<?php include_once 'head.php';?>
</head>
<body>
	<?php include_once 'zaglavlje.php';?>
	<?php include_once 'izbornik.php';?>
	
	
	<!--  Ovo je specifično za stranicu -->
	<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<div class="panel"><h4>Dobrodošli na našu stranicu :)<h4></div>
		</div>
	</div>
	
	
<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<div class="panel">
	
			<div class="row">
			<div class="large-6 medium-6 small-12 columns" >
			<img alt="ivana" src="slike/torta.jpg" />
			</div>
			<div class="large-6 medium-6 small-12 columns" >
			<img alt="ivana" src="slike/torta.jpg" />
			</div>
			</div>
	
			</div>

		</div>

	</div>
			
	
	<!--  /Ovo je specifično za stranicu -->
	
	
	<?php include_once 'podnozje.php';?>

	<script src="<?php echo $putanja;?>js/vendor/jquery.js"></script>
	<script src="<?php echo $putanja;?>js/foundation.min.js"></script>
		<?php include_once 'autorizacija.php';?>
	<script>
      $(document).foundation();
    </script>
</body>
</html>
