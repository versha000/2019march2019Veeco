<?php
/*
Template Name: Philtech
*/
get_header();
  
 ?>
<?php
 $args2 = array(
   'posts_per_page' => -1, 
  'post_type'   => 'post',  
   'suppress_filters' => 0,
  'order' =>'ASC'
);
 
 
 // $ids = array(); 

$latest_phils = get_posts( $args2 );   
 
/*
$id= implode(", ", $ids);

 */
 
$leggititle = get_field("ptitle");
$leggiimg = get_field("phimage" );
 $leggisym = get_field("circle_symbols");

/*
$leggilnk = get_field("leggi");
$leggiurl = get_field("leggi_url");
$leggiarw = get_field("leggi_arrow");
$leggitag = get_field("leggi_tagline");
$leggiimgcrc = get_field("circle_image");
 
*/

?>


<div class="banner-phil-tech">
    <div class="container d-flex align-items-end justify-content-between h-100 p-0">
        <div class="no-gutters">
            <h2>
                <?php echo $leggititle; ?>
            </h2>
        </div>
        <div class="text-right">
            <img class="img-fluid" src="<?php  echo $leggiimg; ?>" alt="" />
        </div>
    </div>
</div>
<div class="phil-background">
    <div class="container">
        <div class="button-group filters-button-group">
            <button value="green" name="r1" id="r1" class="button is-checked" data-filter=".green"><i
                    class="far fa-circle light-green"></i>Sfera
                etica</button>
            <button value="orange" name="r2" id="r2" class="button" data-filter=".orange"><i
                    class="far fa-circle light-orange"></i>Sfera
                produttiva</button>
            <button value="blue" name="r3" id="r3" class="button" data-filter=".blue"><i
                    class="far fa-circle light-blue"></i>Sfera
                economica</button>
            <button style="display:none;" value="all" name="r4" id="r4" class="button" data-filter=".all"><i
                    class="far fa-circle light-blue"></i>All</button>
        </div>

        <div id="grid1" class="grid">
            <?php
    foreach($latest_phils as $latest_philts) {  
		 //	print_r($latest_phil);
 	   $postid =  $latest_philts->ID; 
		 
			?>
            <div class="grid-item element-item all">
                <div class="box-one">

                    <div class="box-video">
                        <?php 	$thumbnail = get_the_post_thumbnail( $postid );   
						echo $thumbnail;  
				?>
                    </div>
                    <a href="<?php the_permalink($postid); ?>">
                        <h3>
                            <?php echo $latest_philts->post_title; ?>
                        </h3>
                    </a>
                    <p>
                        <?php echo $latest_philts->post_excerpt; ?>
                    </p>
                    <?php $url=get_home_url(); 
					 $imgidd =  get_post_meta( $postid, 'leggi_arrow', TRUE); 
					?>

                    <h5><a href="<?php the_permalink($postid); ?>">LEGGI TUTTO
                            <!--  <p style="font-size: 14px;font-weight: 700;Color: #676767;text-decoration: none;display: flex;justify-content: space-between;"><?php // echo "LEGGI TUTTO"; ?></p> -->
                            <?php //echo get_post_meta( $postid, 'leggi', TRUE); ?><img
                                src="http://112.196.98.243/Veeco/wp-content/uploads/2019/01/arrow-new.png">
                            <?php   $cd =wp_get_attachment_metadata($imgidd);  /*echo "
                            $url/wp-content/uploads/".$cd['file'];  ?>"
                            alt="right-arrow">*/ ?></a> </h5>
                  
				
				
				    <p class="tagline">
						   <?php
						   $taged=array();
					$t = wp_get_post_tags($postid);
 
   
                       
                         $taged=array();
                         $tid=array();
				 	$t = wp_get_post_tags($postid);
				 	$k = 1;
						foreach($t as $tags) {
							
							$taged[] = $tags->name;
						    $tid = $tags->term_id;
						    $names =  implode(',',$taged);
						   if($k != count($t)){
							   echo '<a href="'.get_tag_link($tid).'">'.$tags->name.", ".'</a>';
						   }
						   else{
							   echo '<a href="'.get_tag_link($tid).'">'.$tags->name.'</a>';
						   }
						   
						    ?>
						    
						<?php 
						$k++;
						}
						
						 
					?>
					
<!--
					<a href="<?php // echo get_tag_link($tid); ?>">
						    <?php //echo $names; ?></a>
-->
							 
							
							
							
                        <?php //echo get_post_meta( $psstid, 'leggi_tagline', TRUE); ?> 
                   </p>
                  
                    <div class="d-flex justify-content-start card-circle">
                        <?php
						$category_detail=get_the_category($postid);  
						foreach($category_detail as $cd){
						$cat_name =  $cd->cat_name;
						?>
                        <i class="far fa-circle light-<?php echo $cat_name; ?>"></i>&nbsp;
                        <?php }
						 
						 ?>

                    </div>
                </div>
            </div>
            <?php
 }
 ?>
        </div>

        <div id="grid" class="grid">
            <?php
   $categories = get_categories( array(
    'orderby' => 'name',
    'parent'  => 0
) );
 $arr = array();
foreach ( $categories as $category ) {
	 
	   $cid =$category->term_id;
	   $nid =$category->name;
    
    if(isset($nid)){
  
 $args = array(
   'posts_per_page' => -1, 
  'post_type'   => 'post',  
  'order' =>'ASC',
  'category_name' =>$nid, 
);
}
else 
{
	$args = array(
   'posts_per_page' => -1, 
  'post_type'   => 'post',  
   'suppress_filters' => 0,
  'order' =>'ASC'
);
}

 
 $ids = array(); 

$latest_phil = get_posts( $args );   
	  
?>

            <?php foreach($latest_phil as $latest_philtech) {  
		//  echo "<pre>";	print_r($latest_phil);
 	   $psstid =  $latest_philtech->ID; 
		 
			?>
            <div class="grid-item element-item <?php echo $nid; ?> " data-category="transition">
                <div class="box-one">

                    <div class="box-video">
                        <?php 	$thumbnail = get_the_post_thumbnail( $psstid );   
						echo $thumbnail;  
				?>
                    </div>
                    <a href="<?php the_permalink($psstid); ?>">
                        <h3>
                            <?php echo $latest_philtech->post_title; ?>
                        </h3>
                    </a>
                    <p>
                        <?php echo $latest_philtech->post_excerpt; ?>
                    </p>
                    <?php //$url=get_home_url(); 
                $url= "http://112.196.98.243/Veeco/wp-content/uploads";
					 $imgidd =  get_post_meta( $psstid, 'leggi_arrow', TRUE); 
					?>

                    <h5><a href="<?php the_permalink($psstid); ?>">LEGGI TUTTO
                            <?php // echo get_post_meta( $psstid, 'leggi', TRUE); ?><img
                                src="http://112.196.98.243/Veeco/wp-content/uploads/2019/01/arrow-new.png">
                            <?php   $cd =wp_get_attachment_metadata($imgidd);  /*echo "
                            $url/".$cd['file'];" alt="right-arrow">*/ ?></a>
                    </h5>
                
					  
					  
						      <p class="tagline">
						  <?php
                         $tagedv=array();
                         $tidd =array();
				 	$tg = wp_get_post_tags($psstid);
				 	$l=1;
						foreach($tg as $tagsv) {
							$tagedv[] = $tagsv->name;
						 $tidd = $tagsv->term_id;
						if($l != count($tg)){
							   echo '<a href="'.get_tag_link($tidd).'">'.$tagsv->name.", ".'</a>';
						   }
						   else{
							   echo '<a href="'.get_tag_link($tidd).'">'.$tagsv->name.'</a>';
						   }
						   
						   $l++;
					   }
					?>
					 
							
							
							
                        <?php //echo get_post_meta( $psstid, 'leggi_tagline', TRUE); ?> 
                   </p>
                    <div class="d-flex justify-content-start card-circle">
                        <?php
						$category_detail=get_the_category($psstid);  
						foreach($category_detail as $cd){
						$cat_name =  $cd->cat_name;
						?>
                        <i class="far fa-circle light-<?php echo $cat_name; ?>"></i>&nbsp;
                        <?php }
						 
						 ?>

                    </div>
                </div>
            </div>


            <?php
 }
 
 
} 
	
 ?>
        </div>

    </div>
</div>
<?php
   get_footer();
   ?>
