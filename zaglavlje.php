<div class="row">
    	<div class="large-7 medium-6 small-12 columns">
    		<h1><?php echo $naslov;?></h1>
    	</div>
    	
    	<div class="large-5 medium-6 small-12 columns">
    	<?php if(!isset($_SESSION["operater"])){?>
    		<a data-reveal-id="autorizacija" href="#" class="button siroko">Prijava</a>
    		<?php }else{
    		$o=$_SESSION["operater"];
    			
    			?>
    		<a href="<?php echo $putanja;?>odjava.php" class="alert button siroko">Odjava <?php echo $o->ime . " " . $o->prezime;?></a>
    		<?php }?>
    	</div>
</div>