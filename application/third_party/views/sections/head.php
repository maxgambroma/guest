  <body>
 
<div class="row">
	<div class="large-2 small-6 columns">
		<h1><img src="<?php echo base_url(); ?>asset/img/logo_<?php echo $hotel_id ;?>.gif"/></h1>
	</div>
	<div class="large-10 small-6  columns">
		<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button right dropdown">Menu</button>
		<br>
		<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
			<li><a href="<?php echo base_url(); ?>index.php/apphotel/?hotel_id=<?php echo $hotel_id; ?>" >Governanate</a></li>
			<li><a href="<?php echo base_url(); ?>index.php/guasti/?hotel_id=<?php echo $hotel_id; ?>" >Manutentore</a></li>
			<li><a href="<?php echo base_url(); ?>index.php/review/?hotel_id=<?php echo $hotel_id; ?>" >Review</a></li>
			<li><a href="<?php echo base_url(); ?>index.php/bar/?hotel_id=<?php echo $hotel_id; ?>" >Bar</a></li>
			<li><a href="<?php echo base_url(); ?>index.php/magazzino/?hotel_id=<?php echo $hotel_id; ?>">Magazzino</a></li>
		</ul>
	</div>
</div>


     
     
     
       
      
