<?php
/*
Template Name: Contact
*/
get_header();
 
 $conttitle =  get_field('contactpagetitle');
 $addlne =  get_field('addressgroup');
 $mapsrc =  get_field('map');
 
 
 ?>
<div class="conatct">
	<div class="row no-gutters">
		<div class="col-sm-6 col-md-4 bg-yellow">
				<div class="d-flex flex-column h-100">
					<div class="">
						<h2><?php echo $conttitle; ?></h2>
					</div>
					<div class="my-auto">
						<p><?php echo $addlne['addressline1']; ?></p>
						<p><?php echo $addlne['addressline2']; ?><br />
							<?php echo $addlne['addressline3']; ?>
						</p>
						<p><?php echo $addlne['addressline4']; ?> <br /> <?php echo $addlne['addressline5']; ?> <br /> <?php echo $addlne['addressline6']; ?></p>
					</div>
				</div>
				
				</div>
		<div class="col-12 col-sm-6 col-md-8 ">
			<iframe class="w-100 d-block" src="<?php echo $mapsrc; ?>"></iframe>
		</div>
	</div>
</div>
<?php get_footer();
?>
