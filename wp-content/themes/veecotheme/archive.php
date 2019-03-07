<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Veeco
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div class="banner-phil-tech">
    <div class="container d-flex align-items-end justify-content-between h-100 p-0">
        <div class="no-gutters">
            <h2>Tags </h2>
        </div>
        <div class="text-right">
            <img class="img-fluid" src="<?php  echo $leggiimg; ?>" alt="" />
        </div>
    </div>
</div>
	<div class="container">
		<div class="wrap">
			<?php if ( have_posts() ) : ?>
				<!-- <header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header>.page-header -->
			<?php endif; ?>

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) : ?>
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'template-parts/post/content', get_post_format() );

					endwhile;

					the_posts_pagination( array(
						'prev_text' =>  '<span  class="screen-reader-text">' . __( 'Previous page', 'veecotheme' ) . '</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'veecotheme' ) . '</span>',
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'veecotheme' ) . ' </span>',
					) );

				else :

					get_template_part( 'template-parts/post/content', 'none' );

				endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div><!-- .wrap -->
	</div>
<?php get_footer();
