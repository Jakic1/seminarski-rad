<?php include_once 'konfiguracija.php';?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<title>Rođendanska zabava</title>
<?php include_once 'head.php';?>
</head>
<body>
	<?php include_once 'zaglavlje.php';?>
	<?php include_once 'izbornik.php';?>
	<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<div class="panel">
			
			<form action="">
			<fieldset>
			<legend>Podaci</legend>
			<label for="ime">Ime i prezime</label>
			<input type="text" name="ime" id="ime"/>
			<label for="email">Email</label>
			<input type="text" name="email" id="email"/>
			<label for="poruka">Poruka</label>
			<textarea rows="20" cols="70" name="poruka" id="poruka"></textarea> 
			<input type="submit" name="posalji" value="Pošalji" class="button siroko"/>
			</fieldset>
			</form>
			
			
			
			
			</div>
		</div>
	</div>
	<?php include_once 'podnozje.php';?>
	<?php include_once 'autorizacija.php';?>
	<script src="js/vendor/jquery.js"></script>
	<script src="js/foundation.min.js"></script>
	<script>
      $(document).foundation();
    </script>
</body>
</html>
