<?php 
/*
 * $data['temp'] = array('templete' => $temi, 'contenuto' => 'contenuto', 'bar1' => '', 'bar2' => '' );
*/
?>
<?php $this->load->view('sections/head_html'); ?>
<?php $this->load->view('sections/head'); ?>
<?php 
if( $temp['templete'] == 'tem_cb' )
{  
    $this->load->view('sections/tem_cb'); 
} 
if( $temp['templete'] == 'tem_bc' )
{  
    $this->load->view('sections/tem_bc'); 
}
if( $temp['templete'] == 'tem_bcb' )
{  
    $this->load->view('sections/tem_bcb'); 
}
if( $temp['templete'] == 'tem_m' )
{  
    $this->load->view('sections/tem_m'); 
}

if( $temp['templete'] == 'tem_bc_new' )
{  
    $this->load->view('sections/tem_bc_new'); 
}


if( $temp['templete'] == 'tem_full' )
{  
    $this->load->view('sections/tem_full'); 
}

?>
<?php //$this->load->view('sections/panel'); ?>  
<?php $this->load->view('sections/footer'); ?>  
<?php $this->load->view('sections/footer_scripts'); ?>
<?php // $this->output->enable_profiler(TRUE); ?>