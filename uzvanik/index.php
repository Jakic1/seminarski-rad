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
					<div class="large-12 medium-12 small-12 columns" id="uzvanik">Pretraživanje</div>

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
									<th>Ime</th>
									<th>Prezime</th>
									<th>Dob</th>
                                    <th>Rođendan</th>	
                                     <th>Piće</th>	
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
			trazi();		

				return false;
			}
			});

          });
          
          function trazi(){
        	 // alert($("#uvjet").val());
          	$.ajax({
				type: "POST",
				url: "read.php",
				data: "ime=" + $("#uvjet").val(),
				success: function(vratioServer){
					var rezultati=$.parseJSON(vratioServer);
					$("#podaci").html("");
					var rez="";
						$.each(rezultati,function(key,uzvanik){
						
  							rez = rez + "<tr><td>" + uzvanik.sifra + "</td><td>" + uzvanik.ime + "</td><td>" + uzvanik.prezime + "</td><td>" + uzvanik.dob + "</td><td>" + uzvanik.rodjendan + "</td><td>";

  							var pice = uzvanik.pice;
  							$.each(pice,function(key,pice){
  								rez = rez+ pice.naziv +"<br />";
  							});

  							rez=rez+"</td><td class=\"centar\"> <a title=\"Promjeni\" href=\"update.php?sifra=" + uzvanik.sifra + "\"><img alt=\"update\" src=\"<?php echo $putanja;?>img/update.png\" /></a>" + 
  									" || <a title=\"Obriši\" href=\"delete.php?sifra=" + uzvanik.sifra + "\"><img alt=\"delete\" src=\"<?php echo $putanja;?>img/delete.png\" /></a></td></tr>";
  							});

  						$("#podaci").append(rez);

  					}

  				});

            }
		//  trazi();
    </script>
</body>
</html>
