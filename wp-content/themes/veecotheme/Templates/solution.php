<?php
/*
Template Name: Solution
*/
get_header();
 
$solutionmtit=get_field('smaintitle');
$solutionimage=get_field('solimage');
$solutiongrp=get_field('solgroup');
 

?>

<style>
p:last-child {
    margin-bottom: 0px;
}
</style>

<div class="sea-banner" id="why">
    <div class="container d-flex align-items-end justify-content-between h-100 ">
        <div class="no-gutters">
            <h2><?php echo $solutionmtit; ?></h2>
        </div>
        
        <div class="text-right ">
            <img class="img-fluid" src="<?php echo $solutionimage; ?>" alt="" />
        </div>
         
    </div>
</div>
<div class="sea-banner-bottom bg-white align-items-center d-flex">
    
    <div class="container">
        <div class="d-flex" id="mainNav">
            <div class="bd-highlight border-right"><a class="js-scroll-trigger" href="#why">Why</a></div>
            <div class="bd-highlight border-right"><a class="js-scroll-trigger" href="#how">How</a></div>
            <div class="bd-highlight border-right"><a class="js-scroll-trigger" href="#what">What</a></div>
            <div class="bd-highlight border-right"><a class="js-scroll-trigger" href="#who">Who</a></div>
            <div class="bd-highlight "><a class="js-scroll-trigger" href="#withwhom">With whom</a></div>
        </div>
    </div>
</div>
<div id=""></div>
<div class="ligh-gray align-items-center d-flex why-content" >
    <div class="container">
        <div class="d-flex flex-column">
            <div class="bd-highlight">
                <h2 class=" "><?php echo $solutiongrp[0]['soltitle']; ?></h2>
            </div>
            <div class="my-auto" id="how">
                <p><?php echo  $solutiongrp[0]['soldesc'][0]['desc']; ?></p>
                <p><?php echo  $solutiongrp[0]['soldesc'][1]['desc'];  ?></p>
            </div>
        </div>
    </div>
</div>
<div class="bg-white align-items-center d-flex how-content" id="" >
    <div class="container">
        <div class="d-flex flex-column py-3">
            <div class="bd-highlight">
                <h2 class="mt-0"><?php echo $solutiongrp[1]['soltitle']; ?></h2>
            </div>
            <div class="my-auto">
                <p><?php echo  $solutiongrp[1]['soldesc'][0]['desc'];  ?></p>
                <p><?php echo  $solutiongrp[1]['soldesc'][1]['desc'];  ?></p>
                <p><?php // echo  $solutiongrp[1]['soldesc'][2]['desc']; ?></p>
                <p><?php //echo  $solutiongrp[1]['soldesc'][3]['desc']; ?></p>

                <div class="video-img text-center">
                    <a href="#">
						<?php 
						$find = array("<p>", "</p>");
						
						$img= str_replace($find,"",$solutiongrp[1]['soldesc'][2]['desc']); ?>
						<img class="img-fluid" src="<?php echo $img;  ?>"
                            alt="" /></a>
                        <p id="what">&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dark-blue align-items-center d-flex what-content" >
    <div class="container">
        <div class="d-flex flex-column py-4"> 
            <div  class="bd-highlight">
                <h2 class="text-white mt-0"><?php echo $solutiongrp[2]['soltitle']; ?></h2>
            </div>
            <div class="my-auto">
                <p class="text-white py-4"><?php echo  $solutiongrp[2]['soldesc'][0]['desc'];  ?></p>
                <div class="what-inline-text text-white">
                    <p><?php echo  $solutiongrp[2]['soldesc'][1]['desc']; ?>
                        <hr />
                    </p>
                    <p><?php echo  $solutiongrp[2]['soldesc'][2]['desc']; ?>
                        <hr />
                    </p>
                    <p><?php echo  $solutiongrp[2]['soldesc'][3]['desc']; ?>
                        <hr />
                    </p>
                    <p><?php echo  $solutiongrp[2]['soldesc'][4]['desc']; ?></p>
                    <p id="who">&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ligh-gray align-items-center d-flex why-content">
    <div class="container">
        <div class="d-flex flex-column py-4">
            <div class="bd-highlight">
                <h2 class="mt-0"><?php echo $solutiongrp[3]['soltitle']; ?></h2>
            </div>
            <div class="my-auto">
                <p><?php echo  $solutiongrp[3]['soldesc'][0]['desc']; ?></p>
                 <p id="">&nbsp;</p>
            </div>
        </div>
    </div>
</div>


<div class="bg-white align-items-center d-flex how-content" id="withwhom">
    <div class="container">
        <div class="d-flex flex-column py-4">
            <div id="" class="bd-highlight">
                <h2 class="mt-0"><?php echo $solutiongrp[4]['soltitle']; ?></h2>
            </div>
            <div class="my-auto">
                <p><?php echo  $solutiongrp[4]['soldesc'][0]['desc'];  ?></p>
                <p><?php echo  $solutiongrp[4]['soldesc'][1]['desc'];  ?></p>
            </div>
        </div>
    </div>
</div>
</div>

<!--
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
-->
<script>
	
jQuery(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
       jQuery(".top-nav").addClass("light-header");
    } else {
        jQuery(".top-nav").removeClass("light-header");
    }
});

// Year for copy content
jQuery(function() {
    var theYear = new Date().getFullYear();
    jQuery('#year').html(theYear);
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
<?php
get_footer();
?>
