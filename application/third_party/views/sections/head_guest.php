<body>
    
    <nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">My   Site</a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

<!--  <section class="top-bar-section">
     Right Nav Section 
    <ul class="right">
        
        
        
      <li class="active"><a href="#">Right Button Active</a></li>
      <li class="has-dropdown">
        <a href="#">Right Button Dropdown</a>
        <ul class="dropdown">
          <li><a href="#">First link in dropdown</a></li>
          <li class="active"><a href="#">Active link in dropdown</a></li>
        </ul>
      </li>
    </ul>

     Left Nav Section 
    <ul class="left">
      <li><a href="#">Left Nav Button</a></li>
    </ul>
  </section>
        -->
        
        
        
        
              <button href="<?php echo uri_string(); ?>" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button right dropdown"><img src="<?php echo base_url(); ?>asset/img/flags/<?php echo $lg; ?>.gif" alt="Hotel rome" border="0" /> Language</button>
            <br>
            <ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=en" ><img src="<?php echo base_url(); ?>asset/img/flags/en.gif"  border="0" /> English </a> </li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=de" ><img src="<?php echo base_url(); ?>asset/img/flags/de.gif"  border="0" /> Deutsch </a> </li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=es"><img src="<?php echo base_url(); ?>asset/img/flags/es.gif"  border="0" /> Espa&ntilde;ol </a></li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=fr"><img src="<?php echo base_url(); ?>asset/img/flags/fr.gif"  border="0" /> Fran&ccedil;ais </a></li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=it"><img src="<?php echo base_url(); ?>asset/img/flags/it.gif"  border="0" /> Italiano </a></li>

<!--                    <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?lg=jp"><img src="<?php echo base_url(); ?>asset/img/flags/jp.gif"  border="0" /> Nihongo </a></li>
  <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?lg=ru"><img src="<?php echo base_url(); ?>asset/img/flags/ru.gif"  border="0" /> Russian </a></li>
  <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?lg=se"><img src="<?php echo base_url(); ?>asset/img/flags/se.gif"  border="0" /> Svenska </a></li>
                -->
            </ul>
        
        
        
</nav>
    
    
    
    <div class="row">
        <div class="large-2 small-6 columns">
            <h1>  <a href="http://<?php echo $albergo['0']->hotel_web; ?>" ><img src="<?php echo base_url(); ?>asset/img/logo_<?php echo $albergo['0']->hotel_id; ?>.gif"/> </a></h1>
        </div>
        <div class="large-10 small-6  columns">

        </div>

    </div>



       
      
