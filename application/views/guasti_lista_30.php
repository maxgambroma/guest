<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <fieldset>
 <legend>Lista Manutenzioni</legend>
 <ul class="tabs" data-tab role="tablist">
  <li class="tab-title active" role="presentation"><a href="#panel2-1" role="tab" tabindex="0" aria-selected="true" aria-controls="panel2-1">Ultimi 30</a></li>
  <li class="tab-title" role="presentation"><a href="#panel2-2" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-2">Aperti</a></li>
</ul>
<div class="tabs-content">
  <section role="tabpanel" aria-hidden="false" class="content active" id="panel2-1">
    		    <fieldset>
			   <legend>Manutenzioni Lista</legend>
<table border="0" cellpadding="1" width="100%" >
    <thead>
        <tr>
            <th>Data</th>
        <th>Stato</th>
            <th>Descrizione</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach ($guasti as $rowgua) { ?>
            <tr>
                <td> <a href="
                    <?php echo base_url() ?>/index.php/guasti/guasto_camera?camera_id=<?php echo $rowgua->camera_id; ?>&hotel_id=<?php echo $rowgua->hotel_id; ?>"><?php echo $rowgua->guasto_data; ?></a></td>
                <td>

                    <?php
                    if ($rowgua->guasto_stato == 2) {
                        echo '<i class=" greeicon fi-check "></i>';
                    } else {

                        echo '<i class=" readcon fi-dislike "></i>';
                    }
                    ?>

                </td>
                <td> <span class=".stile{foont-size: xx-large; } " > <?php echo $rowgua->numero_camera; ?></span>  <?php echo $rowgua->guasto_note; ?></td>
                
            </tr>
<?php } ?>
    </tbody>
</table>
 </fieldset>
 
	
	
  </section>
  
<section role="tabpanel" aria-hidden="true" class="content" id="panel2-2">
		<fieldset>
		   <legend>Manutenzioni Aperte</legend>
<table border="0" cellpadding="1" width="100%" >
<thead>
	<tr>
		<th>Data</th>
	<th>Stato</th>
		<th>Descrizione</th>
	   
	</tr>
</thead>
<tbody>
	<?php foreach ($guasti_aperti as $row_open) { ?>
		<tr>
			<td> <a href="
				<?php echo base_url() ?>/index.php/guasti/guasto_camera?camera_id=<?php echo $row_open->camera_id; ?>&hotel_id=<?php echo $row_open->hotel_id; ?>"><?php echo $row_open->guasto_data; ?></a></td>
			<td>

				<?php
				if ($row_open->guasto_stato == 2) {
					echo '<i class=" greeicon fi-check "></i>';
				} else {

					echo '<i class=" readcon fi-dislike "></i>';
				}
				?>

			</td>
			<td> <span class=".stile{foont-size: xx-large; } " > <?php echo $row_open->numero_camera; ?></span>  <?php echo $row_open->guasto_note; ?></td>
			
		</tr>
<?php } ?>
</tbody>
</table>
</fieldset>

</section>


</div> 
</fieldset>