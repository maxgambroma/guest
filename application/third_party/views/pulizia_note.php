<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
               
			    <fieldset>

                    <h3>Note Governante</h3>
                    <table border="0" cellpadding=""  width="100%" >
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Bianc</th>
                                <th>Stato</th>
                                <th>Notre</th>
                                <th>Camera</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pulizie as $rowpul) { ?>
                                <tr>
                                    <td><a  href="<?php echo base_url(); ?>/index.php/apphotel/risorsa?conto_id= <?php echo $rowpul->conto_id; ?>&hotel_id=<?php echo $rowpul->hotel_id; ?>"> <?php echo $rowpul->pulizia_data; ?> </a></td>
                                    <td><?php echo $rowpul->cambio_biancheria; ?></td>
                                    <td><?php echo $rowpul->pulizia_stato; ?></td>
                                    <td><?php echo $rowpul->pulizia_note; ?></td>
                                    <td><?php echo $rowpul->numero_camera; ?></td>
                                 
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>

        
          
				 </fieldset>