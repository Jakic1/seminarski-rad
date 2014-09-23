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
<a href="create.php" class="button siroko">Kreiraj novi</a>

				<div class="row">
					<div class="large-12 medium-12 small-12 columns" id="pice">Pretraživanje</div>

				</div>



				<div class="row">

					<div class="large-12 medium-12 small-12 columns">
						<input id="uvjet" type="text" />
					</div>

				</div>

				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<table class="siroko">
						
							<thead>
							
								<tr>
								<th>Šifra</th>
									<th>Naziv</th>
									<th>Vrsta</th>
									<th>Promijeni ili obriši</th>	
								</tr>
							</thead>
							
							<tbody id="podaci"></tbody>

						</table>
						
						
					</div>
				</div>

			</div>
		</div>
	</div>
	<!--  /Ovo je specifično za stranicu -->


	<?php include_once '../podnozje.php';?>

	<script src="<?php echo $putanja;?>js/vendor/jquery.js"></script>
	<script src="<?php echo $putanja;?>js/foundation.min.js"></script>

	<script>
      $(document).foundation();
      $(function(){

		$("#uvjet").keyup(function(event){
			if ( event.which == 13 ) {
				//alert("idem tražiti");
			$.ajax({
				type: "POST",
				url: "read.php",
				data: "naziv=" + $("#uvjet").val(),
				success: function(vratioServer){
					var rezultati=$.parseJSON(vratioServer);
					$("#podaci").html("");
						$.each(rezultati,function(key,pice){
							$("#podaci").append("<tr><td>" + pice.sifra + "</td><td>" + pice.naziv + "</td><td class=\"centar\"><img alt=\"vrsta\" src=\"<?php echo $putanja;?>img/" + pice.vrsta + ".png\" /></td>" +
									"<td class=\"centar\"> <a title=\"Promjeni\" href=\"update.php?sifra=" + pice.sifra + "\"><img alt=\"update\" src=\"<?php echo $putanja;?>img/update.png\" /></a>" + 
									" || <a title=\"Obriši\" href=\"delete.php?sifra=" + pice.sifra + "\"><img alt=\"delete\" src=\"<?php echo $putanja;?>img/delete.png\" /></a></td></tr>");
							});

					}

				});

				return false;
			}
			});





          });
    </script>
</body>
</html>
