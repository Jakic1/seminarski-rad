 <div class="row">
    <div class="large-12 medium-12 small-12 columns">
    <nav class="top-bar" data-topbar="">
  <ul class="title-area">
    <!-- Title Area -->
    <li class="name">

    </li>
    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="">Izbornik</a></li>
  </ul>

  
<section class="top-bar-section">
    <ul class="left">
      <li><a href="<?php echo $putanja;?>index.php">Početna</a></li>
      <li class="divider"></li>
      <?php if(isset($_SESSION["operater"])){?>
    	
      <li><a href="<?php echo $putanja;?>nadzornaPloca.php">Nadzorna ploča</a></li>
      <li><a href="<?php echo $putanja;?>rodjendan/index.php">Rođendan</a></li>
      <li><a href="<?php echo $putanja;?>pice/index.php">Piće</a></li>
      <li><a href="<?php echo $putanja;?>uzvanik/index.php">Uzvanik</a></li>
	  <li><a href="<?php echo $putanja;?>detaljiBaze.php">Detalji Baze</a></li>
      <?php }?>
      
      <li><a href="<?php echo $putanja;?>kontakt.php">Kontakt</a></li>
      <li><a href="<?php echo $putanja;?>onama.php">O nama</a></li>
    </ul>
   
  </section></nav>
    </div>
    </div>