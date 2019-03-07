<?php
/**
 * Veeco functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Veeco
 * @since 1.0
 */

/**
 * Veeco only works in WordPress 4.7 or later.
 */

 
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function veecotheme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/veecotheme
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'veecotheme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'veecotheme' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'veecotheme-featured-image', 2000, 1200, true );

	add_image_size( 'veecotheme-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'veecotheme' ),
		'social' => __( 'Social Links Menu', 'veecotheme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', veecotheme_fonts_url() ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

 	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'veecotheme' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'veecotheme' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'veecotheme' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'veecotheme' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'veecotheme' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'veecotheme_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'veecotheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function veecotheme_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( veecotheme_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'veecotheme_content_width', $content_width );
}
add_action( 'template_redirect', 'veecotheme_content_width', 0 );

/**
 * Register custom fonts.
 */
function veecotheme_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'veecotheme' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function veecotheme_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'veecotheme-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'veecotheme_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function veecotheme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'veecotheme' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'veecotheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'veecotheme' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'veecotheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'veecotheme' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'veecotheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'veecotheme_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function veecotheme_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'veecotheme' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'veecotheme_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function veecotheme_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'veecotheme_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function veecotheme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'veecotheme_pingback_header' );

/**
 * Display custom color CSS.
 */
function veecotheme_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo veecotheme_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'veecotheme_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function veecotheme_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'veecotheme-fonts', veecotheme_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'veecotheme-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'veecotheme-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'veecotheme-style' ), '1.1' );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'veecotheme-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'veecotheme-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'veecotheme-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'veecotheme-style' ), '1.0' );
		wp_style_add_data( 'veecotheme-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'veecotheme-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'veecotheme-style' ), '1.0' );
	wp_style_add_data( 'veecotheme-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'veecotheme-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	//~ $veecotheme_l10n = array(
		//~ 'quote'          => veecotheme_get_svg( array( 'icon' => 'quote-right' ) ),
	//~ );
	
	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'veecotheme-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$veecotheme_l10n['expand']         = __( 'Expand child menu', 'veecotheme' );
		$veecotheme_l10n['collapse']       = __( 'Collapse child menu', 'veecotheme' );
	//	$veecotheme_l10n['icon']           = veecotheme_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'veecotheme-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'veecotheme-skip-link-focus-fix', 'veecothemeScreenReaderText', $veecotheme_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'veecotheme_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function veecotheme_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'veecotheme-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ), array(), '1.1' );
	// Add custom fonts.
	wp_enqueue_style( 'veecotheme-fonts', veecotheme_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'veecotheme_block_editor_styles' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function veecotheme_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'veecotheme_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function veecotheme_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'veecotheme_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function veecotheme_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'veecotheme_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function veecotheme_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'veecotheme_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function veecotheme_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'veecotheme_widget_tag_cloud_args' );

/**
 * Get unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Twenty Seventeen 2.0
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @staticvar int $id_counter
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function veecotheme_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

//~ /**
 //~ * Implement the Custom Header feature.
 //~ */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );



wp_enqueue_style ('style', get_template_directory_uri().'/css/style.css');
wp_enqueue_style ('bootstrap', get_template_directory_uri().'/css/bootstrap.css', array('bootstrasp'));

/*

add_action( 'wp_enqueue_scriptds', 'add_my_script' );
function add_my_script() {
    wp_enqueue_script(
        'bootstrap.bundle',
         get_template_directory_uri() . '/js/bootstrap.bundle.js', 
         array('jquery') 
    );
    wp_enqueue_script(
        'bootstrap.bundle.js.map',
         get_template_directory_uri() . '/js/bootstrap.bundle.js.map', 
         array('jquery') 
    );
}
*/

function swpdocs_theme_name_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
   
}
add_action( 'wp_enqueue_scripts', 'swpdocs_theme_name_scripts' );

 
register_nav_menus( array(
		'top'    => __( 'Top Menu', 'veecotheme' ),
		'bottom' => __( 'Bottom Menu', 'veecotheme' ),
	) );
	
	add_theme_support( 'post-thumbnails' );
	
		function veeco_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'veecotheme' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'veecotheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'veecotheme' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'veecotheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'veecotheme' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'veecotheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'veecotheme' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'veecotheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
			register_sidebar( array(
		'name' => 'Custom Header Position',
		'id' => 'custom_header_position',
		'description' => __( 'An optional widget area for your site header', 'testtt' ),
		'before_widget' => '<aside id="CustomWidget" class="custom_widget">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) ); 
		
		register_sidebar( array(
		'name' => 'Custom Sidebar Posts',
		'id' => 'custom_sidebar_posts',
		'description' => __( 'An optional widget area for your site posts', 'testtt' ),
		'before_widget' => '<aside id="CustomWidget" class="custom_widget">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) ); 
		
		register_sidebar( array(
		'name' => 'Custom Sidebar Tags',
		'id' => 'custom_sidebar_tags',
		'description' => __( 'An optional widget area for your site tags', 'testtt' ),
		'before_widget' => '<aside id="CustomWidget" class="custom_widget">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) ); 
		
		register_sidebar( array(
		'name' => 'Custom Related Posts',
		'id' => 'custom_related_posts',
		'description' => __( 'An optional widget area for your site related posts', 'testtt' ),
		'before_widget' => '<aside id="CustomWidget" class="custom_widget">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) ); 
	
	register_sidebar( array(
		'name'          => __( 'Footer 5', 'veecotheme' ),
		'id'            => 'sidebar-6',
		'description'   => __( 'Add widgets here to appear in your footer.', 'veecotheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'veecotheme' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Add widgets here to appear in your footer.', 'veecotheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
 
add_action( 'widgets_init', 'veeco_widgets_init' );


function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

require get_parent_theme_file_path( '/custom-header.php' );

add_filter('acf/format_value/type=text', 'do_shortcode');

 $utl = get_home_url().'/event/';
 //$actual_link = 'http://'.$_SERVER['HTTP_HOST'].get_query_var('pagename');
  $currentpage= $_SERVER['REQUEST_URI'];
 // $lastpage = substr($utl,21);
  $lastpage = substr($utl,15);
  $finalurl =  get_home_url().'/events/list/?tribe-bar-date=2016-04-07';
  
  
if($currentpage==$lastpage){
	 ?>
	 <script>
		 var a = "<?php echo $finalurl; ?>";
	window.location.assign(a)
	
	 </script>
<?php
}

add_action("wp_ajax_get_tags_colour", "get_tags_colour");
add_action("wp_ajax_nopriv_get_tags_colour","get_tags_colour");

function get_tags_colour() {
	
	$clr = $_POST['val'];
	$t = explode(',',$clr);	
	echo $vlue = implode(",",$t);
	 	 
 

	wp_die();
}
	

/*  Start Slider custom post types */

/*
  function slider_custom_post_type() {
    $label = array(
        'name'                  =>   __( 'Slideshow', 'slider' ),
        'singular_name'         =>   __( 'Slideshow', 'slider' ),
        'add_new_item'          =>   __( 'Add New Slide', 'slider' ),
        'all_items'             =>   __( 'All Slides', 'slider' ),
        'edit_item'             =>   __( 'Edit Slides', 'slider' ),
        'new_item'              =>   __( 'New Slides', 'slider' ),
        'view_item'             =>   __( 'View Slides', 'slider' ),
        'not_found'             =>   __( 'No Slides Found', 'slider' ),
        'not_found_in_trash'    =>   __( 'No Slides Found in Trash', 'slider' )
    );
 
    $supports = array(
        'title',
        'editor',
        'excerpt',
        'thumbnail'

    );
 
    $args = array(
        'label'         =>   __( 'Slider', 'slider' ),
        'labels'        =>   $label,
        'description'   =>   __( 'A list of upcoming events', 'slider' ),
        'public'        =>   true,
        'show_in_menu'  =>   true,
        'menu_icon'     =>   IMAGES . 'slider.svg',
        'has_archive'   =>   true,
        'rewrite'       =>   true,
        'supports'      =>   $supports
    );
 
    register_post_type( 'slidespost', $args );
}
add_action( 'init', 'slider_custom_post_type' );

function slider_add_event_info_metabox() {
    add_meta_box(
        'slider-event-info-metabox',
        __( 'Event Info', 'uep' ),
        'slider_render_event_info_metabox',
        'slidespost',
        'side',
        'core'
    );
}
add_action( 'add_meta_boxes', 'slider_add_event_info_metabox' );  */
 
	/**** Custom Slider ***/
	
	
	
	function uep_custom_post_type() {
    $labels = array(
        'name'                  =>   __( 'Events', 'uep' ),
        'singular_name'         =>   __( 'Event', 'uep' ),
        'add_new_item'          =>   __( 'Add New Event', 'uep' ),
        'all_items'             =>   __( 'All Events', 'uep' ),
        'edit_item'             =>   __( 'Edit Event', 'uep' ),
        'new_item'              =>   __( 'New Event', 'uep' ),
        'view_item'             =>   __( 'View Event', 'uep' ),
        'not_found'             =>   __( 'No Events Found', 'uep' ),
        'not_found_in_trash'    =>   __( 'No Events Found in Trash', 'uep' )
    );
 
    $supports = array(
        'title',
        'editor',
        'excerpt',
        'thumbnail'

    );
 
    $args = array(
        'label'         =>   __( 'Events', 'uep' ),
        'labels'        =>   $labels,
        'description'   =>   __( 'A list of upcoming events', 'uep' ),
        'public'        =>   true,
        'show_in_menu'  =>   true,
        'menu_icon'     => 'dashicons-calendar',
        'suppress_filters' => true,
        'has_archive'   =>   true,
        'rewrite'       =>   true,
        'supports'      =>   $supports
    );
 
    register_post_type( 'event', $args );
}
add_action( 'init', 'uep_custom_post_type' );

function uep_add_event_info_metabox() {
    add_meta_box(
        'uep-event-info-metabox',
        __( 'Event Info', 'uep' ),
        'uep_render_event_info_metabox',
        'event',
        'side',
        'core'
    );
}
add_action( 'add_meta_boxes', 'uep_add_event_info_metabox' );

 
 
function uep_render_event_info_metabox( $post ) {
 
    // generate a nonce field
    wp_nonce_field( basename( __FILE__ ), 'uep-event-info-nonce' );
 
    // get previously saved meta values (if any)
    $event_start_date = get_post_meta( $post->ID, 'event-start-date', true );
    $event_end_date = get_post_meta( $post->ID, 'event-end-date', true );
    $event_venue = get_post_meta( $post->ID, 'event-venue', true );
 
    // if there is previously saved value then retrieve it, else set it to the current time
    $event_start_date = ! empty( $event_start_date ) ? $event_start_date : time();
 
    //we assume that if the end date is not present, event ends on the same day
    $event_end_date = ! empty( $event_end_date ) ? $event_end_date : $event_start_date;
 
    ?>
 
<label for="uep-event-start-date"><?php _e( 'Event Start Date:', 'uep' ); ?></label>
        <input class="widefat uep-event-date-input" id="uep-event-start-date" type="text" name="uep-event-start-date"  value="<?php echo date( 'F d, Y', $event_start_date ); ?>" />
 
<label for="uep-event-end-date"><?php _e( 'Event End Date:', 'uep' ); ?></label>
        <input class="widefat uep-event-date-input" id="uep-event-end-date" type="text" name="uep-event-end-date" value="<?php echo date( 'F d, Y', $event_end_date ); ?>" />
 
<label  for="uep-event-venue"><?php _e( 'Event Venue:', 'uep' ); ?></label>
        <input   class="widefat" id="uep-event-venue" type="text" name="uep-event-venue"  value="<?php echo $event_venue; ?>" />
 <script>
 
 (function( $ ) {
 
    $( '#uep-event-start-date' ).datepicker({
        dateFormat: 'MM dd, yy',
         timeInput: true,
     timeFormat: 'hh:mm',
        onClose: function( selectedDate ){
            $( '#uep-event-end-date' ).datepicker( 'option', 'minDate', selectedDate );
        }
    });
    $( '#uep-event-end-date' ).datepicker({
        dateFormat: 'MM dd, yy',
         timeInput: true,
         timeFormat: 'hh:mm',
        onClose: function( selectedDate ){
            $( '#uep-event-start-date' ).datepicker( 'option', 'maxDate', selectedDate );
        }
    });
 
})( jQuery );

 </script>
    <?php  }
    function uep_save_event_info( $post_id ) {
 
    // checking if the post being saved is an 'event',
    // if not, then return
    if ( 'event' != $_POST['post_type'] ) {
        return;
    }
 
    // checking for the 'save' status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST['uep-event-info-nonce'] ) && ( wp_verify_nonce( $_POST['uep-event-info-nonce'], basename( __FILE__ ) ) ) ) ? true : false;
 
    // exit depending on the save status or if the nonce is not valid
    if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
        return;
    }
 
    // checking for the values and performing necessary actions
    if ( isset( $_POST['uep-event-start-date'] ) ) {
        update_post_meta( $post_id, 'event-start-date', strtotime( $_POST['uep-event-start-date'] ) );
    }
 
    if ( isset( $_POST['uep-event-end-date'] ) ) {
        update_post_meta( $post_id, 'event-end-date', strtotime( $_POST['uep-event-end-date'] ) );
    }
 
    if ( isset( $_POST['uep-event-venue'] ) ) {
		update_post_meta( $post_id, 'event-venue', sanitize_text_field( $_POST['uep-event-venue'] ) );
    }
}
add_action( 'save_post', 'uep_save_event_info' );

function uep_custom_columns_head( $defaults ) {
    unset( $defaults['date'] );
 
    $defaults['event_start_date'] = __( 'Start Date', 'uep' );
    $defaults['event_end_date'] = __( 'End Date', 'uep' );
    $defaults['event_venue'] = __( 'Venue', 'uep' );
 
    return $defaults;
}
add_filter( 'manage_edit-event_columns', 'uep_custom_columns_head', 10 );

function uep_custom_columns_content( $column_name, $post_id ) {
 
    if ( 'event_start_date' == $column_name ) {
        $start_date = get_post_meta( $post_id, 'event-start-date', true );
        echo date( 'F d, Y', $start_date );
    }
 
    if ( 'event_end_date' == $column_name ) {
        $end_date = get_post_meta( $post_id, 'event-end-date', true );
        echo date( 'F d, Y', $end_date );
    }
 
    if ( 'event_venue' == $column_name ) {
        $venue = get_post_meta( $post_id, 'event-venue', true );
        echo $venue;
    }
}
add_action( 'manage_event_posts_custom_column', 'uep_custom_columns_content', 10, 2 );

 remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

function paulund_remove_default_image_sizes( $sizes) {
    unset( $sizes['thumbnail']);
    unset( $sizes['medium']);
    unset( $sizes['large']);

    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'paulund_remove_default_image_sizes');
  

?>
 

 

