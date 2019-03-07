<?php get_header();  


$getslider = get_field('home_slider');
  
  
  $args = array(
   'posts_per_page' => 3, 
  'post_type'   => 'event',  
  'suppress_filters' => 0,
   'orderby' => 'date',                  
   'order'   => 'ASC'
);
 
$getevent = get_posts( $args );   
 
  $etit = get_field('evntit');  
  $colorclass0= get_field('sliderbackground');
  $colorclass1= get_field('sliderbackground2');
  $colorclass2= get_field('sliderbackground3');
  
  $backgroundimage0= get_field('imgbackground');
  $backgroundimage1= get_field('imgbackground2');
  $backgroundimage2= get_field('imgbackground3');
  $colorclassv = array();
  $colorclassimg = array();
 foreach ($getslider as $slde) {  
		     $colorclassv[]  = $slde['sliderbackgroundcolor']; 
		     $colorclassimg[]  = $slde['sliderbackgroundimg']; 
		     
		 }
		 //~ echo "<pre>";
		 //~ print_r($colorclassv);
		  //~ print_r($colorclassimg);
		 //~ echo "</pre>";
		 
		     //~ $singleArray = array();

    
?>
<script>
 var js_array = [<?php echo '"'.implode('","', $colorclassv).'"' ?>];
   
    </script>

<!-- #f39b34;-->
<div id="bp3" class="banner">

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
			<?php
			$k=0;
			$j = count($getslider);
			for($i=0;$i<$j;$i++){ ?>
				 <li class="<?php if($k==0){ echo 'active'; } ?>" data-target="#carouselExampleControls" data-slide-to="<?php echo $i; ?>"></li>
				 <?php
				 $k++;
			 }
			 ?>
			<!--  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
       
        </ol>
       
        <div class="carousel-inner">
            <?php  $i=0;
			    foreach ($getslider as $slde) { 
			
					
					?>
            <div id="dyanmic-colour<?php echo $i; ?>" class="carousel-item <?php  if($i==0) { echo 'active'; } ?>">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-6 left-content">
                            <h2 class="text-white pb-5"><?php  echo $slde['title']; ?></h2>
                            <p class="text-white pb-4"><?php  echo $slde['description']; ?></p>
                            <a href="<?php  echo $slde['read_link']; ?>"
                                class="text-white"><?php echo $slde['read_text']; ?> <img class="img-fluid white-arrow"
                                    src="<?php  echo $slde['arrow_image']; ?> " alt="" /></a>
                        </div>
                        <?php $coloreds = $slde['sliderbackgroundcolor'];
							  $imgslder = $slde['sliderbackgroundimg'];
                        
                        if($slde['sliderbackgroundcolor']!= ''){ 
							$coloreds = $slde['sliderbackgroundcolor'];
							//echo $coloreds ;
							 ?>
						 <script>
							 var i = "<?php echo  $i;?>";
							var imageUrl =   "<?php echo  $imgslder;?>";
						 
							 jQuery("#dyanmic-colour"+i).css("background-color", '<?php echo $coloreds ;?>');
							 jQuery("#dyanmic-colour"+i).css('background-image', 'url(' + imageUrl + ')');  
						</script>	
						<?php } ?>
                       
                        <div class="col-12 col-sm-6 text-right">
                            <img src="<?php  echo $slde['slider_image']; ?>" alt="New York" class="img-fluid py-1">
                        </div>
                    </div>
                </div>
            </div>
            <?php  
				$i++;
				} ?>


            <a class="carousel-control-prev" data-target="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" data-target="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>


      

    </div>
</div>


<?php 
     
      $home_page_text = get_field('home_page_text'); 
     /* echo "<pre>";
      print_r($home_page_text);
      echo "</pre>"; */
      $i=0;
      foreach($home_page_text as $key=>$value){ 
	   
	  $philtechtxt = $value['home_text']['hometxt'];
	  $philtechhomelnk = $value['home_text']['homelnk'];
	  $philtechhomelnkimg = $value['home_text']['homelnkimg'];
	  $philtechhomeimglnktxt = $value['home_text']['homeimglnktxt'];
	   
	  $philtechimgd = $value['home_image']['homeimages']; 
	  $philtechtxtd = $value['home_image']['hometxts']; 
      
       
		   if ($i % 2 == 0) {
			    
			   
      ?>

<div class="section">

    <div class="container-fluid">
        <div class="row flex-column-reverse flex-md-row">
            <?php if($i == 2) {  ?>

            <div class="col-md-6 bg-red content d-flex flex-column">
                <div class="text-center my-auto">
                    <section class="intro carousel slide h-auto" id="carouselExampleCaptions">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <?php		 $i=0;
						foreach($getevent as $gevent)
						{ 
						$e_id =  $gevent->ID;
						$e_content =  $gevent->post_content;
						$e_title =  $gevent->post_title;
						$e_excerpt = $gevent->post_excerpt;
						 
						$timestamp=get_post_meta($e_id,'event-start-date',TRUE);
						$evdate =  date('d F Y', $timestamp); 
						
						$time=strtotime($evdate);
						 $month=date("M",$time);
						 $year=date("Y",$time);
						 $day=date("d",$time);
						?>
                            <div class="carousel-item <?php  if($i==0) { echo 'active'; } ?> ></div>">

                                <a href="<?php the_permalink($e_id); ?>">
                                    <div class="section-orange">
                                        <h2 class="d-flex justify-content-center text-center text-white mb-2 ">
                                            <?php echo $day; ?><span
                                                class="date text-white"><?php echo $month; ?></br><?php echo $year; ?></span>
                                        </h2>
                                        <p class="text-white lead"><?php echo $e_title; ?></p>
                                        <p class="text-white red-slide-content"><b><?php echo $e_excerpt; ?></p></b></p>
                                    </div>
                                </a>
                            </div>
                            <?php  
							$i++;
							} ?>
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button"
                            data-slide="prev">
                            <!--span class="carousel-control-prev-icon" aria-hidden="true"></span-->
                            <img class="img-fluid" src="<?php  bloginfo('template_directory'); ?>/img/icon-1.png"
                                alt="" />
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button"
                            data-slide="next">
                            <!--span class="carousel-control-next-icon" aria-hidden="true"></span-->
                            <img class="img-fluid" src="<?php  bloginfo('template_directory'); ?>/img/icon-2.png"
                                alt="" />
                            <span class="sr-only">Next</span>
                        </a>
                    </section>
                </div>
                <div style="font-weight:700;" class="ml-auto arrow-tab">
                    <a style="text-decoration:none;" href="<?php  echo $philtechhomelnk; ?>"
                        class="text-white"><?php  echo $philtechhomeimglnktxt; ?> <img class="img-fluid white-arrow"
                            src="<?php  echo $philtechhomelnkimg; ?>" alt="" /></a>
                </div>
            </div>


            <?php } else{?>

            <div
                class="col-md-6 bg-<?php if($i==0){ echo 'green'; } elseif($i==1){ echo 'blue'; }  else { echo 'red'; } ?> content-box flex-column">
                <div class="left-border m-auto">
                    <p class="text-white "><?php echo $philtechtxt; ?> </p>
                </div>
                <div class="ml-auto arrow-tab">
                    <a style="text-align:center;" href="<?php  echo $philtechhomelnk; ?>"
                        class="text-white"><?php  echo $philtechhomeimglnktxt; ?> <img class="img-fluid white-arrow"
                            src="<?php  echo $philtechhomelnkimg; ?>" alt="" /></a>
                </div>
            </div>


            <?php } ?>


            <div
                class="<?php if($i==0){ echo 'green'; } elseif($i==1){ echo 'blue'; }  else { echo 'event-box-text'; } ?> col-md-6 white-bg d-flex align-items-center content-box col-sm-push-6 flex-column phil-box-text">
                <a style="text-align:center;"
                    href="<?php if($i==0){ echo get_home_url().'/philtech'; } elseif($i==1) { echo get_home_url().'/solution'; } else {echo get_home_url().'/events-list'; }?>">
                    <img class="img-fluid" src="<?php  echo $philtechimgd; ?>" alt="" />
                    <h1><?php  echo $philtechtxtd; ?></h1>
                </a>
            </div>

        </div>
    </div>
</div>
</div>

<?php
  }
  else {
	 
	  
     ?>

<div class="section">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 white-bg d-flex align-items-center content-box flex-column solution-box-text">
                <a style="text-align:center;"
                    href="<?php if($i==0){ echo get_home_url().'/philtech'; } elseif($i==1) { echo get_home_url().'/solution'; } else {echo get_home_url().'/events-list'; }?>">
                    <img class="img-fluid" src="<?php  echo $philtechimgd; ?>" alt="" />
                    <h1><?php  echo $philtechtxtd; ?></h1>
                </a>
            </div>
            <div
                class="col-md-6 bg-<?php if($i==0){ echo 'green'; } elseif($i==1){ echo 'blue'; }  else { echo 'red'; } ?> content-box flex-column">
                <div class="left-border m-auto">
                    <p class="text-white "><?php echo $philtechtxt; ?> </p>
                </div>
                <div class="ml-auto arrow-tab">
                    <a href="<?php  echo $philtechhomelnk; ?>" class="text-white"><?php  echo $philtechhomeimglnktxt; ?>
                        <img class="img-fluid white-arrow" src="<?php  echo $philtechhomelnkimg; ?>" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
  }
  
 
  $i++;
       
			} 
			
			
		  ?>


</div>
<!--
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
-->

<script>
jQuery(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
        $(".top-nav").addClass("light-header");
    } else {
        $(".top-nav").removeClass("light-header");
    }
});

// Year for copy content
jQuery(function() {
    var theYear = new Date().getFullYear();
    $('#year').html(theYear);
});
window.onscroll = function() {
    growShrinkLogo()
};

function growShrinkLogo() {
    var Logo = document.getElementById("Logo")
    if (document.body.scrollTop > 5 || document.documentElement.scrollTop > 5) {
        Logo.style.width = '100px';
    } else {
        Logo.style.width = '160px';
    }
}
</script>
<?php get_footer();

   
     ?>
