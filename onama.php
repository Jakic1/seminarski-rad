<?php include_once 'konfiguracija.php';
?>
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
			
			<div class="row">
			<div class="large-12 medium-12 small-12 columns" >
			<p> 
			 Dobrodošli na stranicu organizacije rođendanski zabava. <br />
			 Naša stranica je specifična za organizaciju proslave rođendana.
			 Namjenjena je svima koji žele na lakši način pratiti organizaciju svoje rođendanske zabave. 
			 Naime, pomoću nje možete lakše obavijestiti svoje uzvanike gdje i kada slavite. 
			 Također možete vidjeti što Vaši uzvanici žele piti kako bi im to mogli i pripremiti.<br />
			 Ono što je specifično za ovu stranicu jest da možete pretraživati podatke, brisati ih, mijenjati i dodavati. <br />
			 
			                                    UŽIVAJTE!
			</p>
			</div>
			</div>
			
			</div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<div class="panel">
			
			<div class="row">
			<div class="large-10 medium-10 small-12 columns" >
			<img alt="ivana" src="slike/sladoled.jpg" />
			</div>
			</div>
			
			</div>
		</div>
	</div>
	<?php include_once 'podnozje.php';?>
	<?php include_once 'autorizacija.php';?>
	<script src="<?php echo $putanja;?>js/vendor/jquery.js"></script>
	<script src="<?php echo $putanja;?>js/foundation.min.js"></script>
	<script>
      $(document).foundation();
    </script>
</body>
</html>
