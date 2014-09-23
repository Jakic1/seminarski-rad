<div id="autorizacija" class="reveal-modal" data-reveal>
  
  
  <form action="">
			<fieldset>
			<legend>Pristupni podaci</legend>
			<label for="email">Email</label>
			<input type="text" name="email" id="email" value="ijakic1@ffos.hr"/>
			<label for="lozinka">Lozinka</label>
			<input type="password" name="lozinka" id="lozinka" value="i"/>
			<a id="autoriziraj"class="button siroko">Autoriziraj</a>
			</fieldset>
			</form>
  	<p id="porukaGreske"></p>
  <a class="close-reveal-modal">&#215;</a>
</div>

<script>

	$(function(){
		$("#autoriziraj").click(function(){
	//alert("korisnik=" + $("#korisnik").val() + "&lozinka=" + $("#lozinka").val());
				$.ajax({
					type: "POST",
					url:"<?php echo $putanja;?>autoriziraj.php",
					data: "email=" + $("#email").val() + "&lozinka=" + $("#lozinka").val(),
					success: function(poruka){
						if(poruka=="DA"){
							window.location="nadzornaPloca.php";
						}
						else{
							$("#porukaGreske").addClass("tiny alert button");
							$("#porukaGreske").css("width","100%");
							$("#porukaGreske").css("text-align","center");
							$("#porukaGreske").html("Neispravna kombinacija korisničkog imena i lozinke");
						}

						}

					});


				return false;
			});




		});
	

</script>