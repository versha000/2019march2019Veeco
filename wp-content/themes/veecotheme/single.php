<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Veeco
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
     <div>
       <!--<div class="container">-->
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
			/*	if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'veecotheme' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'veecotheme' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">'. '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'veecotheme' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'veecotheme' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">'. '</span></span>',
				) );*/

			endwhile; // End of the loop.
			?>
</div>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
