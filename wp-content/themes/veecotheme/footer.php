<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Veeco
 * @since 1.0
 * @version 1.2
 */

?>

<div class="section-footer">
    <div class="container">
        <div class="row mb-md-3">
            <div class="col-sm-4 col-3 text-center text-md-left"><a href="<?php echo get_home_url(); ?>"><img
                        class="img-responsive" src="<?php  header_image(); ?>" alt="" /></a></div>
            <div class="col-sm-4 col-3 p-0 text-center">
                <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
                <div class="sidebar new-sidebar">
                    <?php dynamic_sidebar( 'sidebar-3' ); ?>
                </div>
                <?php endif; ?>

                <?php //wp_nav_menu( array( 'theme_location' => 'bottom') ); ?>
                <!--  <div class="p-1 bd-highlight"><a href="#" class="text-gray">Privacy Policy</a></div>
                     <div class="p-1 bd-highlight"><a href="#" class="text-gray">Cookie Policy</a></div> -->
            </div>

            <?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
            <div class="col-sm-4 col-6 text-center right-footer-text">
                <?php dynamic_sidebar( 'sidebar-4' ); ?>
            </div>
        </div>

        <?php endif; ?>
        <!-- <div class="p-1 bd-highlight">
                  <div class="d-flex flex-column bd-highlight mb-3">
                     <div class="p-1 bd-highlight text-gray">info@veeco.it</div>
                     <div class="p-1 bd-highlight text-gray">T +39 02 77428030</div>
                     <div class="p-1 bd-highlight text-gray">F +39 02 76340836</div>
                  </div>
               </div> -->

        <div class="bottom-text">
            <?php
			//	$bottomtxt = get_field('homefooter');	 */ ?>
            <?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
            <a style="pointer-events: none;cursor: default;" href="#">
                <p class="">
                    <?php //echo $bottomtxt; ?>
                    <?php dynamic_sidebar( 'sidebar-6' ); ?>

                </p>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
  $findlnk = get_home_url().'/tag/'; 
  $dlin = get_home_url().'/tag/'; 
	  $currentpage= $_SERVER['REQUEST_URI']; 
	  
	  $enlastpage = substr($findlnk,31);
	  $lastpage = substr($findlnk,28);
	  $allenlastpage  = substr($dlin,31);
 
 
   // $evens = get_home_url();
     $evens =  home_url( add_query_arg( array(), $wp->request ) );

    
	  $currentpages= $_SERVER['REQUEST_URI']; 
	  $lastpages = substr($evens,28);
     $clastpages = substr($evens,28);
	  
	       if ( is_singular( 'event' ) ) {
	     if (strpos($evens,$lastpages) !== false || strpos($evens,$clastpages) !== false) {
	     //~ if ( 'post' === 'event') {
		    ?>
<style>
.singlepost {
    display: none !important;
}
</style>

<?php
		   
	   } 
	}   
	   else {
		    ?>
<style>
.singleevnt {
    display: none !important;
}
</style> <?php   
	   }
	   
	/* else{
		   ?>
<style>
.singleevnt {
    display: none !important;
}
</style>

<?php
		   
	   }  
		  */ 
	
	 	   
	     if ( !is_singular() ) {
 if (strpos($currentpage,$lastpage) !== false ||  strpos($currentpage,$enlastpage) !== false) {
   ?>
<style>
#main .format-standard {
    margin-top: 20px;
    background: #f2f2f2;
}

#main .format-standard .entry-header {
    border-bottom: none !important;
    padding: 0;
    border-radius: 5px;
    overflow: hidden;
}

#main .format-standard .entry-header .event-banner {
    padding: 20px;
}

#main .format-standard .entry-header .event-banner .container {
    padding: 0px;
}

#main .format-standard .entry-header .event-banner h2 {
    margin: 0px;
    margin-top: 0px;
    font-weight: 300;
    margin-top: 10px;
}

#main .format-standard .entry-header .event-banner h2>a {
    color: #000 !important;
}

a.post-edit-link {
    color: blue !important;
}

.entry-date,
.updated {
    display: none !important;
}

.section-footer {
    margin-top: auto;
}

body {
    display: flex;
    flex-direction: column;
}

html {
    height: 100%;
    margin: 0;
}

.event-banner {
    border-bottom: none !important;
}

.event-banner a {
    color: #000000 !important;
    text-decoration: none;


    margin-bottom: 0px !important;
}

div.container h2.entry-title a {
    font-size: 25px !important;
    color: blue !important;
}

.tzcustom_item img {
    display: none;
}

.singlepost {
    display: none !important;
}

.widget .menu {
    padding: 0px;
}
</style>

<?php
}
}
  $colorclass0= get_field('sliderbackground');
  //~ $colorclass1= get_field('sliderbackground2');
  //~ $colorclass2= get_field('sliderbackground3');
  
  $backgroundimage0= get_field('imgbackground');
  //~ $backgroundimage1= get_field('imgbackground2');
  //~ $backgroundimage2= get_field('imgbackground3');
  
		//~ $colorclassv = array();
		//~ $colorclassimg = array();
		//~ foreach ($getslider as $slde) {  
		     //~ $colorclassv[]  = $slde['sliderbackgroundcolor']; 
		     //~ $colorclassimg[]  = $slde['sliderbackgroundimg']; 
		     
		 //~ }
		  
 

		     ?>
<!--
                            <script>
							  var js_array = [<?php //echo  $colorclassv; ?>];
							  alert(js_array);
							  console.log(js_array);
							  alert(js_array.length);
							    document.getElementById("demo").innerHTML = js_array.length;

							  for (var i = 0; i < myArr.length; ++i) {
						  alert('value at index [' + i + '] is: [' + myArr[i] + ']');
						}

							var dcd = "<?php //echo $colorclassv; ?>";
							
							var text = "";
							  var i;
							  for (i = 0; i < 5; i++) {
								text += "The number is " + i + "<br>";
							  }
							  document.getElementById("demo").innerHTML = text;
							  
							jQuery("document").ready(function(){
	 
							jQuery("#dyanmic-colour0").css("background-color", dcd);
							jQuery("#dyanmic-colour0").css("background-color", dcd);
						});
							</script>
							 
-->
<?php 
                           //   echo $slde['imgbackground'];  
                              
 

?>
<!--script-->
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

 
<script src="https://npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js"></script>

<script src="http://112.196.98.243/Veeco/wp-content/themes/veecotheme/js/jquery.easing.min.js"></script>

<script>
//jQuery("#dyanmic-colour"+i).css("background-color", '<?php echo $coloreds ;?>');

jQuery(document).ready(function() {
    if (window.location.href.indexOf("/en/") > -1) {

        jQuery("#n2").show();
        jQuery("#n1").hide();
    } else {


        jQuery("#n1").show();
        jQuery("#n2").hide();

    }


});

jQuery(document).ready(function() {
    if (window.location.href.indexOf("/en/") > -1) {
        jQuery("#s2").show();
        jQuery("#s1").hide();
    } else {
        jQuery("#s2").hide();
        jQuery("#s1").show();

    }


});

jQuery(document).ready(function() {
    if (window.location.href.indexOf("/en/") > -1) {
        jQuery("#q1").show();
    } else {
        jQuery("#q2").show();

    }


});

jQuery(document).ready(function() {
    if (window.location.href.indexOf("/en/") > -1) {
        jQuery("#p1").show();
    } else {
        jQuery("#p2").show();

    }


});

jQuery(document).ready(function() {
    if (window.location.href.indexOf("/en/") > -1) {
        jQuery("#catgen").show();
    } else {
        jQuery("#catg").show();

    }


});
 
        jQuery(document).ready(function(){
		 	//~ jQuery("#dyanmic-colour0").removeClass("carousel-item active");
		 	 setTimeout(function(){ jQuery("#dyanmic-colour0").addClass("carousel-item active")}, 1000);
		});
		 
       


var dc = "<?php echo $colorclass0; ?>";
//~ var dc2 = "<?php echo $colorclass1; ?>";
//~ var dc3 = "<?php echo $colorclass2; ?>";

var imageUrl = "<?php echo $backgroundimage0; ?>";
//~ var imageUrl2 = "<?php echo $backgroundimage1; ?>";
//~ var imageUrl3 = "<?php echo $backgroundimage2; ?>";

jQuery("document").ready(function() {

    //jQuery("#dyanmic-colour0").css("background-color", dc);
    //~ jQuery("#dyanmic-colour1").css("background-color", dc2);
    //~ jQuery("#dyanmic-colour2").css("background-color", dc3);


    //jQuery("#dyanmic-colour0").css('background-image', 'url(' + imageUrl + ')');
    //~ jQuery("#dyanmic-colour1").css('background-image', 'url(' + imageUrl2 + ')');
    //~ jQuery("#dyanmic-colour2").css('background-image', 'url(' + imageUrl3 + ')');

});

jQuery("document").ready(function() {
    setTimeout(function() {
        jQuery("#r4").trigger('click');
    }, 2);
});
var $grid = jQuery('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'masonry',
    masonry: {
        columnWidth: $('#grid1').find('.thumb')[0],
        isFitWidth: true,
        gutter: 10
    }
});
// filter functions
var filterFns = {
    // show if number is greater than 50
    numberGreaterThan50: function() {
        var number = $(this).find('.number').text();
        return parseInt(number, 10) > 50;
    },
    // show if name ends with -ium
    ium: function() {
        var name = $(this).find('.name').text();
        return name.match(/ium$/);
    }
};
// bind filter button click
$('.filters-button-group').on('click', 'button', function() {
    var filterValue = $(this).attr('data-filter');
    // use filterFn if matches value
    filterValue = filterFns[filterValue] || filterValue;
    $grid.isotope({
        filter: filterValue
    });
});
// change is-checked class on buttons
$('.button-group').each(function(i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on('click', 'button', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $(this).addClass('is-checked');
    });
});
jQuery("document").ready(function() {
jQuery(".navbar-toggler-right").click(function() {
 
});
});


(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 30)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 30 
  });

})(jQuery); // End of use strict

</script>
<script type="text/javascript">
jQuery(window).scroll(function() {
    var sticky = jQuery('.header'),
        scroll = jQuery(window).scrollTop();

    if (scroll >= 100) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
});

</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
    jQuery("a").on("click touchend", function(e) {
        var el = $(this);
        var link = el.attr("href");
        window.location = link;
    });
    });
</script> 



<script type="text/javascript">
$('.carousel').carousel({
    interval: 4000
});
</script>
<script>
    // jQuery('.navbar-toggler').click(function() {
    //     if (jQuery('#collapsingNavbar').is(':visible')) {
    //         jQuery(".sea-banner-bottom").removeClass("is-open");
    //     } else {
    //     jQuery(".sea-banner-bottom").addClass("is-open");
    //     }
    // });
</script>

<style>
.button-group .light-green {
    color: #3ab290;
    border: 1px solid #3ab290;
    border-radius: 100%;
    height: 18px;
    width: 18px;
}

.sea-banner-bottom.is-open{
    top:114px
}

.button-group .light-orange {
    color: #f9a038;

    border: 1px solid #f9a038;
    border-radius: 100%;
    height: 18px;
    width: 18px;

}

.button-group .light-blue {
    color: #5ec0c6;

    border: 1px solid #5ec0c6;
    border-radius: 100%;
    height: 18px;
    width: 18px;
}

#wpfront-scroll-top-container {
    opacity: 1;
    right: 20px;
    bottom: 20px;
    display: block;
    background: #e5584f;
    padding: 4px 5px;
    border-radius: 5px;
}

#wpfront-scroll-top-container img {
    width: 25px;
}
 
 
    .navbar-toggler {
        position: relative;
    }

    .navbar-toggler:focus,
    .navbar-toggler:active {
        outline: 0;
    }

    .navbar-toggler span {
        display: block;
        background-color: #444;
        height: 3px;
        width: 25px;
        margin-top: 4px;
        margin-bottom: 4px;
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
        position: relative;
        left: 0;
        opacity: 1;
    }

    .navbar-toggler span:nth-child(1),
    .navbar-toggler span:nth-child(3) {
        -webkit-transition: transform .35s ease-in-out;
        -moz-transition: transform .35s ease-in-out;
        -o-transition: transform .35s ease-in-out;
        transition: transform .35s ease-in-out;
    }

    .navbar-toggler:not(.collapsed) span:nth-child(1) {
        position: absolute;
        left: 12px;
        top: 10px;
        -webkit-transform: rotate(135deg);
        -moz-transform: rotate(135deg);
        -o-transform: rotate(135deg);
        transform: rotate(135deg);
        opacity: 0.9;
    }

    .navbar-toggler:not(.collapsed) span:nth-child(2) {
        height: 12px;
        visibility: hidden;
        background-color: transparent;
    }

    .navbar-toggler:not(.collapsed) span:nth-child(3) {
        position: absolute;
        left: 12px;
        top: 10px;
        -webkit-transform: rotate(-135deg);
        -moz-transform: rotate(-135deg);
        -o-transform: rotate(-135deg);
        transform: rotate(-135deg);
        opacity: 0.9;
    }
    @media(max-width:767px){
        #what,#who{
            height:30vw;
        }
        .why-content{
            height:auto !important
        }
    }

</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<?php wp_footer(); ?>
</body>

</html>
