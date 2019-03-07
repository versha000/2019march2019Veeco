<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Veeco
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
	if ( is_sticky() && is_home() ) :
		echo veecotheme_get_svg( array( 'icon' => 'thumb-tack' ) );
	endif;
	?>

    <header class="entry-header">
        <div class="event-banner">
            <div class="container">
                <?php 	/* $postlink =  get_field('postlink'); 
			echo "<pre>";
			print_r( $postlink);
			echo "</pre>";*/
			
			?>


                <?php
		if ( 'post' === get_post_type() ) {
			echo '<div class="container">';
				if ( is_single() ) {
				//	veecotheme_posted_on();
				} else {
					echo veecotheme_time_link();
					veecotheme_edit_link();
				};
			echo '</div><!-- .entry-meta -->';
		};

		if ( is_single() ) {
		 
			$url = get_home_url().'/philtech/';
			$evturl = get_home_url().'/events-list/';
		    //~ $myStr = get_the_title(115);
			//~ $result = substr($myStr, 5);
			
			 

			?>
			
                <a class="singlepost" href="<?php echo $url; ?>" class="text-green"><img class="img-fluid" src="http://112.196.98.243/Veeco/wp-content/uploads/2019/01/green-arrow.png"
            <?php //echo get_home_url().'/wp-content/uploads/2019/01/green-arrow.png' ?>
                        alt="" /> Phil-tech</a>

                <a class="singleevnt" href="<?php  echo $evturl; ?>" class="text-red"><img class="img-fluid" src="http://112.196.98.243/Veeco/wp-content/uploads/2019/01/red-arrow.png"<?php //  echo get_home_url().'/wp-content/uploads/2019/01/red-arrow.png' ?>
                        alt="" />
                    <?php echo  "Event"; ?></a>

                <h1>
					 
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </h1>
            </div>
        </div>
        </div>
        <div class="bg-white event-section event-divide mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="left-event">
                       <?php  if ( has_post_thumbnail() ) {  
					the_post_thumbnail();
				} ?> 
				 

                           

                               <p> <?php 	the_content(); ?></p><br>
                              
                               <?php
				 echo "<br>";
				    if ( is_singular( 'event' ) ) {
					  
				  }
				  else {
					  ?>
					  
					  <div class="mb-3">
						  <?php
					  $cid=  get_the_ID();
							echo "<p style='font-weight:bold;font-size:15px; margin:0;'>TAGS</p>";
							//~ echo "<br>";
							$rrarray =  array();
							 $tis= get_the_tags($cid); 
							 foreach($tis as $t){
								 						 
							     $rrarray[] = $t->name;
						 
							
						}
						//echo $srarray = implode(' | ',$rrarray);
						$ssrarray = array();
						echo $srarray = implode(', ',$rrarray);
						?>
					</div>
					
							 <div class="mb-3">
								 <?php
							echo "<p id='catg' style='display:none;font-weight:bold;font-size:15px; margin:0;'>CATEGORIA</p>"; 
							echo "<p id='catgen' style='display:none;font-weight:bold;font-size:15px; margin:0;'>CATEGORY</p>"; 
							 
							 
							
							   $scid=  get_the_category($cid);
							    foreach($scid as $sv){
								 						 
							     $ssrarray[] = $sv->name;
						 
							
						}
						      echo $vsrarray = implode(' | ',$ssrarray);
						      ?>
						      </div>
							    <?php
							  // echo $catname = $scid[0]->name;
							
				 ?>
						<div class="mb-3">
								 <?php
						   if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                                <div>

                                    
                                        <p class="mb-2" style="font-weight:bold;font-size:12px !important;"><b>Share</b></p>
                                    

                                   
                                        <?php dynamic_sidebar( 'sidebar-1' ); ?>
                                    

                                </div> 
                                <?php endif;  
                                
                              
					} 
				?>
 
                            <?php  
								?>
                            <!--      <P class="m-0 share-text"><b>Share</b></P>
                                    <div class="d-flex justify-content-star">
                                            <div class="event-icon">
                                                    <i class="fab fa-linkedin-in"></i>
                                            </div>
                                            <div class=" event-icon">
                                                    <i class="fab fa-google-plus-g"></i>
                                            </div>
                                        <div class=" event-icon">
                                                <i class="fab fa-facebook-f"></i>
                                        </div>
                                        <div class=" event-icon">
                                                <i class="fab fa-twitter"></i>
                                        </div>
                                    </div>-->
                        </div>
                    </div>
</div>


                    <?php if ( is_singular( 'event' ) ) {
					 
					  ?>


                    <div id="rel_evnt" class="col-sm-3 offset-sm-1">

                        <p style="color: #333333 !important;font-size: 14px !important">
                            <?php
									$evntid = get_the_ID();
									$mainevenue=get_post_meta($evntid,'event-venue',TRUE);
									$cat = 'event';
									/*if ($cat) { 
									 $argsc=array(
									'post_type' => $cat,
									'post__not_in' => array($evntid),
										'suppress_filters' => true,
									'posts_per_page'=>1,
									'ignore_sticky_posts'=>1
									);*/
									 $timestampstart=get_post_meta($evntid,'event-start-date',TRUE);
								 	$timestampend=get_post_meta($evntid,'event-end-date',TRUE);
									$evdate =  date('d F Y', $timestampstart); 								   
									 $startdate =  date('g:i', $timestampstart); 
								    $enddate =  date('g:i', $timestampend); 
									$my_query = new WP_Query($argsc);
								/*	if( $my_query->have_posts() ) {
									while ($my_query->have_posts()) : $my_query->the_post(); */  ?> 
                            <div class="border-bottom pb-2 event-section">
								 <h3 id="n1" style="display:none;font-size: 18px;margin: 15px 0;color: #ea6964 !important;text-decoration:none;font-weight: 600;">Data e or</h3>
								   <h3 id="n2" style="display:none;font-size: 18px;margin: 15px 0;color: #ea6964 !important;text-decoration:none;font-weight: 600;">Date and time</h3>
								 
								  
								  <div class="right-event">
                                    <p>
                                        <?php   echo $evdate; ?>
                                        <p>
                                            <p>
                                                <?php  echo $startdate.'-'.$enddate;  ?>
                                            </p>
                                </div>  
                                
                                
                                <?php 
										 $eidd = get_the_ID();
										$timestampstart=get_post_meta($eidd,'event-start-date',TRUE);
										$timestampend=get_post_meta($eidd,'event-end-date',TRUE);
										$evenue=get_post_meta($eidd,'event-venue',TRUE);
										  $evsdate =  date('d F Y', $timestampstart); 						   
										$startdate =  date('g:i', $timestampstart); 
										$enddate =  date('g:i', $timestampend); 										
										 ?>

                          <!--      <a href="<?php //echo get_permalink();?>" rel="bookmark" title="<?php //the_title_attribute(); ?>">
                                    <h3 class="" style="font-size: 18px;margin: 15px 0;color: #ea6964 !important;text-decoration:none;font-weight: 600;">
                                        <?php // the_title(); ?>
                                    </h3>
                                </a>
                                <div class="right-event">
                                    <p>
                                        <?php // echo $evsdate; ?>
                                        <p>
                                            <p>
                                                <?php  //echo $startdate.'-'.$enddate;  ?>
                                            </p>
                                </div> -->
                                
                            </div>

                            <?php
								/*	endwhile;
									}
									wp_reset_query();
									}*/
									
									?>
									  <div class="border-bottom pb-2 event-section">
						 <h3 id="s1" style="display:none;font-size: 18px;margin: 15px 0;color: #ea6964 !important;text-decoration:none;font-weight: 600;">Luogo</h3>
						 <h3 id="s2" style="display:none;font-size: 18px;margin: 15px 0;color: #ea6964 !important;text-decoration:none;font-weight: 600;">Venue</h3>
						
						 <div class="right-event">
							<p><?php echo $mainevenue; ?> </p>
							 </div>
						 </div>
                    </div>
                   
						 


                    <?php 
                    
   
	
	
	  
	 
	   
	  
				} 
				else { 
			    if ( is_active_sidebar( 'custom_sidebar_posts' ) ) : ?>
                    <div class="col-sm-3 offset-sm-1 right-event event-section">
                        <div class="d-flex flex-column ">
                            <div class="border-bottom  pb-2">
								<?php   $evens =  home_url( add_query_arg( array(), $wp->request ) );
								 $fing  = substr($evens,28);
								 ?>
							<?php	//if (strpos('en',$evens) !== true){ ?>
								 
                                <h3 id="q1" style="display:none;"><span>Recent posts</span></h3>
			<?php //}else {  ?> 
				 <h3 id="q2" style="display:none;"><span>Articoli recenti</span></h3>
				 <?php  //} ?>
                                <p style="color: #333333 !important;font-size: 14px !important">
                                    <?php dynamic_sidebar( 'custom_sidebar_posts' ); ?>
                                </p>

                            </div>
                            <?php endif; ?>
                            <?php if ( is_active_sidebar( 'custom_sidebar_tags' ) ) : ?>
                            <div class="border-bottom pb-2 right-event event-section">
                                <h3><span>Tag cloud</span></h3>
                                <p>
                                    <?php dynamic_sidebar( 'custom_sidebar_tags' ); ?>
                                </p>

                            </div>
                            <?php endif; ?>


                            <div id="rel_pos" class="right-event event-section">
									<?php//	if (strpos($fing,$evens) !== false){ ?>
                                <h3 id ="p1"  style="display:none;"><span>Related posts</span></h3>
			<?php// }else {  ?> 
				  <h3  id ="p2" style="display:none;" id="q1"><span>Leggi anche</span></h3>
				 <?php // } ?>
                               
                                <p style="font-weight:400 !important;">
                                    <?php
								$postid = get_the_ID();
								$cat = wp_get_post_categories($postid);
								if ($cat) {
								 
								$first_cat = $cat[0];
								$args=array(
								'category__in' => array($first_cat),
								'post__not_in' => array($postid),
								'posts_per_page'=>1,
								'ignore_sticky_posts'=>1
								);
								$my_query = new WP_Query($args);
								if( $my_query->have_posts() ) {
								while ($my_query->have_posts()) : $my_query->the_post(); 
								$posid=get_the_ID();
								?>
                                    <a href="<?php echo get_permalink($posid);?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                        <?php the_title(); ?></a>

                                    <?php
								endwhile;
								}
								wp_reset_query();
								}
								}
								?>
                                </p>
                                <p>
                                    <?php // dynamic_sidebar( 'custom_related_posts' ); ?>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php 
							 
				
				
 
				
		
		 /*sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'veecotheme' ),
			get_the_title()
		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'veecotheme' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) ); */
		?>

        <?php	
			
		 //	the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
    </header><!-- .entry-header -->

    <?php /*if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
    <div class="post-thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    </div><!-- .post-thumbnail -->
    <?php endif; ?> */ ?>

    <div style="display:none;" class="entry-content">
        <?php/*
		/* translators: %s: Name of current post  
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'veecotheme' ),
			get_the_title()
		) );
 
		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'veecotheme' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) ); */
		?>
    </div><!-- .entry-content -->
    <?php /*posts_nav_link(' · ', __('after'), __('before')); ?>

    <?php
	if ( is_single() ) {
		veecotheme_entry_footer();
	} */
	?>

</article><!-- #post-## -->
