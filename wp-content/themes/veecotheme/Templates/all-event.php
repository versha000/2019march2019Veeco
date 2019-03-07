<?php
/*
Template Name: The Events Template
*/
get_header();
 ?>
 
 
 
 <?php
  
  $args = array(
   'posts_per_page' => -1, 
  'post_type'   => 'event',  
   'suppress_filters' => 0,
	  'orderby' => 'date',
     //'orderby' => 'post_date',
    'order'   => 'ASC'
);
 
$getevent = get_posts( $args );   
 
  $etit = get_field('evntit'); 
 
 ?>
         <div class="red-event-banner d-flex align-items-end">
            <div class="container">
                <div class="row">
                    <div class="no-gutters">
                        <h2><?php echo  $etit; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    <?php
		foreach($getevent as $gevent)
		{

		  
		$e_id =  $gevent->ID;
		$e_content =  $gevent->post_content;
		$e_title =  $gevent->post_title;
		$e_excerpt = $gevent->post_excerpt;
		//echo "</pre>";

		 $timestamp=get_post_meta($e_id,'event-start-date',TRUE);
	     $evdate =  date('d F Y', $timestamp); 
		 
		?>
        <div class="red-event-banner-bottom">
            <div class="container">
                <div class="eventsdata">
                    <h3><?php echo $evdate; ?></h3>
                 <h2>  <a href="<?php  the_permalink($e_id); ?>"><?php echo $e_title; ?></h2></a> 
                    <h4><?php echo $e_excerpt; ?></h4>
                    <p><?php echo $e_content; ?></p>
                </div>
            </div>
        </div>
        <?php }  
       get_footer();
       ?>
