<?php
/**
 * Template snippet for custom theme functions
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

define( 'SNIPPETS_DIR', 'template-snippets' );
define( 'DEFAULT_HEADER_IMAGE', get_stylesheet_directory_uri() . '/assets/img/keitaro-hero-bg.png' );
define( 'DEFAULT_OG_IMAGE_URL', get_stylesheet_directory_uri() . '/assets/img/keitaro-default-og-photo-1200x630.png' );

// Initialize theme
function keitaro_theme_setup() {

	// Remove WordPress version meta tag
	add_filter( 'the_generator', '__return_false' );

	// Register Custom Headers
	register_default_headers(
		 array(
			 'keitaro' => array(
				 'url'           => DEFAULT_HEADER_IMAGE,
				 'thumbnail_url' => DEFAULT_HEADER_IMAGE,
				 'description'   => __( 'The default hero image of Keitaro Inc.', 'keitaro' ),
			 ),
		 )
		);

	require_once dirname( __FILE__ ) . '/' . SNIPPETS_DIR . '/class-keitaro-theme-settings.php';

	// Load text domain for localization
	load_theme_textdomain( 'keitaro' );

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

	add_image_size( 'keitaro-featured-image', 2000, 1200, true );
	add_image_size( 'keitaro-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 960;

	// This theme uses wp_nav_menu() in two locations.
	
register_nav_menus(
	array(
		'main'             => __( 'Main Menu', 'keitaro' ),
		'footer'           => __( 'Footer Menu' ),
		'social'           => __( 'Social Links', 'keitaro' ),
		'footer-secondary' => __( 'Secondary Footer Menu', 'keitaro' ),
		'footer-services'	=> __( 'Services Menu', 'keitaro' ),
		'footer-products'	=> __( 'Products Menu', 'keitaro' ),
	)
 );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		 'html5',
		array(
			'comment-form',
			'comment-list',
			'search-form',
			'gallery',
			'caption',
		)
		);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		 'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
		);

	// Add theme support for Custom Logo.
	add_theme_support(
		 'custom-logo',
		array(
			'flex-width' => true,
			'height'     => 100,
		)
		);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add theme support for custom headers
	add_theme_support(
		 'custom-header',
		array(
			'default-image' => DEFAULT_HEADER_IMAGE,
			'flex-height'   => true,
			'flex-width'    => true,
		)
		);

	// $starter_content = array();
	// add_theme_support( 'starter-content', $starter_content );

}

add_action( 'after_setup_theme', 'keitaro_theme_setup' );

function custom_excerpt_length( $length ) {
	return 30;

}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_more( $more ) {
	return '...';

}

add_filter( 'excerpt_more', 'custom_excerpt_more' );

/* Set custom meta descriptions */

function custom_meta_descriptions() {

	/* Reset post data to the post in the main query */
	wp_reset_postdata();

	$meta_description = get_bloginfo( 'description' ) . ' ' . __( 'by', 'keitaro' ) . ' ' . get_bloginfo( 'name' ) . '.';

	if ( is_archive() ) :
		$meta_description = wp_strip_all_tags( get_the_archive_title() . ' ' . __( 'on', 'keitaro' ) . ' ' . get_home_url() . '.' );
	elseif ( is_home() ) :
		$meta_description = __( 'Recent content by', 'keitaro' ) . ' ' . get_bloginfo( 'name' ) . ' ' . __( 'on', 'keitaro' ) . ' ' . get_home_url() . '.';
	elseif ( is_page_template( 'parent.php' ) ) :
		$meta_description = $meta_description;
	elseif ( is_singular() && ! is_front_page() ) :
		$meta_description = get_the_excerpt();
	elseif ( is_search() ) :
		$meta_description = __( 'Search results for', 'keitaro' ) . ' ' . get_search_query() . ' ' . __( 'on', 'keitaro' ) . ' ' . get_home_url() . '.';
	endif;

	?>
	<meta name="description" content="<?php echo esc_html( $meta_description ); ?>">
	<?php

}

add_action( 'wp_head', 'custom_meta_descriptions' );

/* Set custom meta tags for Open Graph */

function open_graph_tags() {

	/* We are not adding explicit tags for title and description as these
	 * can be reused from the existing meta tags */

	/* Featured images will only be set for posts and
	 * the default image will be displayed for pages */
	if ( get_the_post_thumbnail() ) :

		?>
		<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>" />
	<?php else : ?>
		<meta property="og:image" content="<?php echo esc_url( DEFAULT_OG_IMAGE_URL ); ?>" />
	<?php

	endif;

}

add_action( 'wp_head', 'open_graph_tags' );

/* Set custom meta tag for Google Search Console */

function google_search_console_tags() {
	$gsc_verification_id = get_option( 'keitaro_settings' )['gsc_verification_id'] ?? false;

	if ( $gsc_verification_id ) :
		printf( '<meta name="google-site-verification" content="%s" />', esc_html( $gsc_verification_id ) );
	endif;

}

add_action( 'wp_head', 'google_search_console_tags' );

// Add static CSS and JS theme assets
function keitaro_theme_scripts() {

	// Futura PT font from Typekit
	wp_enqueue_script( 'futura-pt', get_stylesheet_directory_uri() . '/assets/js/futura-pt.min.js', null, null, true );

	// Main keitaro_theme stylesheet
	wp_enqueue_style( 'keitaro-theme-style', get_stylesheet_uri(), null, filemtime( get_stylesheet_directory() . '/style.css' ) );

	// jQuery
	wp_enqueue_script( 'jquery' );

	// Bootstrap JS modules
	wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', null, null, true );

	// Custom JS minified
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.min.js', null, null, true );

	// Prism.js - load only for pages, posts and custom post types
	if ( is_singular() && ! is_page() ) :
		// Main keitaro_theme stylesheet
		wp_enqueue_style( 'prism-css', get_stylesheet_directory_uri() . '/assets/css/prism-okaidia.css', null, null );
		wp_enqueue_style( 'prism-toolbar-css', get_stylesheet_directory_uri() . '/assets/css/prism-toolbar.css', null, null );
		wp_enqueue_script( 'clipboard-js', get_stylesheet_directory_uri() . '/assets/js/clipboard.min.js', null, null, true );
		wp_enqueue_script( 'prism-js', get_stylesheet_directory_uri() . '/assets/js/prism.min.js', null, null, true );
		wp_enqueue_script( 'prism-toolbar-js', get_stylesheet_directory_uri() . '/assets/js/prism-toolbar.min.js', null, null, true );
		wp_enqueue_script( 'prism-clipboard-js', get_stylesheet_directory_uri() . '/assets/js/prism-copy-to-clipboard.min.js', null, null, true );
	endif;

	// JS for testing layout issues
	// wp_enqueue_script( 'layout-test', get_stylesheet_directory_uri() . '/assets/js/layout-test.js' );

}

add_action( 'wp_enqueue_scripts', 'keitaro_theme_scripts' );

add_action( 'wp_enqueue_scripts', 'keitaro_jquery_deregister' );

function keitaro_jquery_deregister() {
	$jquery_path = '/assets/js/jquery.min.js';
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_bloginfo( 'template_url' ) . $jquery_path, null, null, true );

}

// Add favicon links to <head>
function keitaro_theme_favicons() {

	?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/keitaro-favicon-32x32.png' ); ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/keitaro-favicon-144x144.png' ); ?>">
	<?php

}

add_action( 'wp_head', 'keitaro_theme_favicons' );

// Override default WordPress logo on wp-login.php
function keitaro_theme_login_logo() {

	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );

	?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo esc_url( $image[0] ); ?>);
			width: 225px;
			height: auto;
			background-size: 225px auto;
			background-repeat: no-repeat;
			padding-bottom: 30px;
		}
	</style>
	<?php

}

add_action( 'login_enqueue_scripts', 'keitaro_theme_login_logo' );

// Require Keitaro Service widget
require_once SNIPPETS_DIR . '/widgets/class-keitaro-service.php';

// Require Keitaro Call to Action widget
require_once SNIPPETS_DIR . '/widgets/class-keitaro-call-to-action.php';

// Require Keitaro Call to Action widget
require_once SNIPPETS_DIR . '/widgets/class-keitaro-icon-block.php';

// Require Keitaro Location widget
require_once SNIPPETS_DIR . '/widgets/class-keitaro-location.php';

// Require Contact Form widget
require_once SNIPPETS_DIR . '/widgets/class-keitaro-contact-form.php';

// Require Contact Form widget
require_once SNIPPETS_DIR . '/widgets/class-keitaro-job-application-form.php';

// Require Twitter Grid widget
require_once SNIPPETS_DIR . '/widgets/class-keitaro-tweets.php';

// Require Keitaro Page Text widget
require_once SNIPPETS_DIR . '/widgets/class-keitaro-page-text.php';

// Require Keitaro Button widget
require_once SNIPPETS_DIR . '/widgets/class-keitaro-button.php';

// Register Widget areas
function keitaro_widgets_init() {

	register_sidebar(
		 array(
			 'name'          => __( 'Default Sidebar', 'keitaro' ),
			 'description'   => __( 'Reserved for any predefined default WordPress content. This sidebar is actually not shown anywhere, just used to collect any default widgets transfered on activation.', 'keitaro' ),
			 'id'            => 'sidebar-1',
			 'before_widget' => '<div class="sidebar-default %2$s">',
			 'after_widget'  => '</div>',
		 )
		);

	register_sidebar(
		 array(
			 'name'          => __( 'Page Widgets Sidebar', 'keitaro' ),
			 'description'   => __( 'Reserved for widgets shown on all pages', 'keitaro' ),
			 'id'            => 'keitaro_page_widgets',
			 'before_widget' => '<div class="widget-wrapper %2$s">',
			 'after_widget'  => '</div>',
		 )
		);

			register_sidebar(
		 array(
			 'name'          => __( 'Services', 'keitaro' ),
			 'description'   => __( 'Reserved for Keitaro Service widgets and rendered within the Hero section on the home page.', 'keitaro' ),
			 'id'            => 'keitaro_services',
			 'before_widget' => '<div class="card border-0 service-wrapper %2$s">',
			 'after_widget'  => '</div>',
			 'before_title'  => '<h3 class="service-title">',
			 'after_title'   => '</h3>',
		 )
		);

	register_sidebar(
		 array(
			 'name'          => __( 'Service Icons', 'keitaro' ),
			 'description'   => __( 'Reserved for Image widgets and rendered below the Hero section on the home page.', 'keitaro' ),
			 'id'            => 'keitaro_service_icons',
			 'before_widget' => '<li>',
			 'after_widget'  => '</li>',
			 'before_title'  => '',
			 'after_title'   => '',
		 )
		);

	register_sidebar(
		 array(
			 'name'          => __( 'Call to Action', 'keitaro' ),
			 'description'   => __( 'Reserved for Keitaro Call to Action widgets and rendered above the footer section on static pages and the front page.', 'keitaro' ),
			 'id'            => 'keitaro_call_to_action',
			 'before_widget' => '<div class="container d-flex flex-column align-items-center call-to-action-wrapper %2$s">',
			 'after_widget'  => '</div>',
			 'before_title'  => '<h3 class="call-to-action-title">',
			 'after_title'   => '</h3>',
		 )
		);

	register_sidebar(
		 array(
			 'name'          => __( 'Icon Blocks', 'keitaro' ),
			 'description'   => __( 'Reserved for Keitaro Icon Block widgets and rendered within static pages.', 'keitaro' ),
			 'id'            => 'keitaro_icon_blocks',
			 'before_widget' => '<div class="icon-block-wrapper %2$s">',
			 'after_widget'  => '</div>',
			 'before_title'  => '<h3 class="page-icon-blocks-title">',
			 'after_title'   => '</h3>',
		 )
		);

	register_sidebar(
		 array(
			 'name'          => __( 'Locations', 'keitaro' ),
			 'description'   => __( 'Reserved for Keitaro Location widgets and rendered within static pages with the Contact page template.', 'keitaro' ),
			 'id'            => 'keitaro_locations',
			 'before_widget' => '<div class="location %2$s">',
			 'after_widget'  => '</div>',
			 'before_title'  => '<h4 class="location-title">',
			 'after_title'   => '</h4>',
		 )
		);

	register_sidebar(
		 array(
			 'name'          => __( 'Contact', 'keitaro' ),
			 'description'   => __( 'Reserved for Contact Form widgets and rendered within static pages with the Contact page template.', 'keitaro' ),
			 'id'            => 'keitaro_contact',
			 'before_widget' => '<div class="widget-contact %2$s">',
			 'after_widget'  => '</div>',
			 'before_title'  => '<header class="entry-header"><h2 class="entry-title">',
			 'after_title'   => '</h2></header>',
		 )
		);

	register_sidebar(
		array(
			'name'          => __( 'Job Application', 'keitaro' ),
			'description'   => __( 'Reserved for Job Application Form widgets and rendered within static pages with the Job Application page template.', 'keitaro' ),
			'id'            => 'keitaro_job_application',
			'before_widget' => '<div class="widget-contact %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<header class="entry-header"><h2 class="entry-title">',
			'after_title'   => '</h2></header>',
		)
		);

	register_sidebar(
		 array(
			 'name'          => __( 'Twitter', 'keitaro' ),
			 'description'   => __( 'Reserved for Tweets widgets and rendered on the first page of the blog.', 'keitaro' ),
			 'id'            => 'keitaro_twitter',
			 'before_widget' => '<div class="twitter-content-widget %2$s">',
			 'after_widget'  => '</div>',
			 'before_title'  => '<h2 class="twitter-content-widget-title text-center">',
			 'after_title'   => '</h2>',
		 )
		);

	if ( class_exists( 'Keitaro_Service' ) ) :
		register_widget( 'Keitaro_Service' );
	endif;

	if ( class_exists( 'Keitaro_Call_To_Action' ) ) :
		register_widget( 'Keitaro_Call_To_Action' );
	endif;

	if ( class_exists( 'Keitaro_Icon_Block' ) ) :
		register_widget( 'Keitaro_Icon_Block' );
	endif;

	if ( class_exists( 'Keitaro_Location' ) ) :
		register_widget( 'Keitaro_Location' );
	endif;

	if ( class_exists( 'Keitaro_Tweets' ) ) :
		register_widget( 'Keitaro_Tweets' );
	endif;

	if ( class_exists( 'Keitaro_Contact_Form' ) ) :
		register_widget( 'Keitaro_Contact_Form' );
	endif;

	if ( class_exists( 'Keitaro_Job_Application_Form' ) ) :
		register_widget( 'Keitaro_Job_Application_Form' );
	endif;

	if ( class_exists( 'Keitaro_Button' ) ) :
		register_widget( 'Keitaro_Button' );
	endif;

	if ( class_exists( 'Keitaro_Page_Text' ) ) :
		register_widget( 'Keitaro_Page_Text' );
	endif;

}

add_action( 'widgets_init', 'keitaro_widgets_init' );


// Shortcode to modify hero title to show first three words in bold
add_shortcode( 'keitaro-hero-title', 'keitaro_hero_title_shortcode' );

function keitaro_hero_title_shortcode() {

	$formatted_title    = explode( ' ', get_bloginfo( 'description' ) );
	$formatted_title[2] = esc_html( $formatted_title[2] ) . '<span class="hero-subtitle">';
	printf( '<h2 class="hero-title">%s</span></h2>', implode( ' ', $formatted_title ) );

}

/* Add support for hyperlinks to default WordPress Image widget */

function keitaro_add_media_image_url( $widget, $return, $instance ) {

	// Are we dealing with a media_image widget?
	if ( 'media_image' === $widget->id_base ) {

		$handle = 'image_anchor_href';

		// Get already set hyperlink value or empty string
		$hyperlink = isset( $instance[ $handle ] ) ? $instance[ $handle ] : '';

		?>
		<p>
			<label for="<?php echo esc_attr( $widget->get_field_id( $handle ) ); ?>">
				<?php esc_html_e( 'Hyperlink:', 'keitaro' ); ?>
			</label>
			<input class="widefat title" type="url" id="<?php echo esc_attr( $widget->get_field_id( $handle ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( $handle ) ); ?>" value="<?php echo esc_url( $hyperlink ); ?>" />
		</p>
		<?php

	}

}

/*
 * Generate navigation menu for a predefined/registered menu location
 */

function keitaro_menu( $menu_location, $menu_class = '', $menu_id = '', $collapse = false ) {

	if ( has_nav_menu( $menu_location ) ) :

		if ( ! $menu_id ) :
			$menu_id = uniqid( 'navbar-' );
		endif;

		?>
		<?php if ( $collapse ) : ?>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#<?php echo esc_attr( $menu_id ); ?>" aria-expanded="false">
				<span class="navbar-toggler-icon"></span>
			</button>
		<?php endif; ?>
		<!-- <nav class="navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'keitaro' ); ?>"> -->
			<div id="<?php echo esc_attr( $menu_id ); ?>" class="<?php echo $collapse ? 'collapse navbar-collapse' : ''; ?>">
				<?php

				wp_nav_menu(
					 array(
						 'theme_location' => $menu_location,
						 'container'      => 'ul',
						 'menu_id'        => $menu_location . '-menu',
						 'menu_class'     => $menu_location . '-navigation ' . $menu_class,
					 )
					);

				?>
			</div>
		<!-- </nav> -->
		<?php

	endif;

}

/*
 * Override default link of the login form logo
 */

function keitaro_login_logo_url() {
	return home_url();

}

add_filter( 'login_headerurl', 'keitaro_login_logo_url' );

/*
 * Override default title attribute of the login form logo
 */

function keitaro_login_logo_url_title() {
	return get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' );

}

add_filter( 'login_headertitle', 'keitaro_login_logo_url_title' );

function keitaro_child_pages_list( $parent_page_id ) {
	$child_pages = get_children(
			array(
				'post_parent' => $parent_page_id,
				'post_type'   => 'page',
				'order'       => 'ASC',
				'orderby'     => 'menu_order',
			)
	);

	if ( $child_pages ) :

		?>
		<div class="service-list">
			<?php foreach ( $child_pages as $page ) : ?>
				<h4 class="service-list-item"><a href="<?php the_permalink( $page->ID ); ?>"><?php echo esc_html( $page->post_title ); ?></a></h4>
			<?php endforeach; ?>
		</div>
		<?php

	endif;

}

function keitaro_author_box( $author = false, $display = true, $print = '' ) {

	$author_title           = get_the_author_posts_link( $author );
	$author_description     = get_the_author_meta( 'description' );
	$author_posts_number    = get_the_author_posts( $author );
	$author_comments_number = count( get_comments( array( 'post_author' => $author ) ) );
	$author_work_position   = get_the_author_meta( 'user_work_position' );
	$author_stats           = sprintf(
		 '<p class="author-stats"><small>' .
			// translators: Authors Stats: sentence
			__( 'Contributed', 'keitaro' ) . ' <strong>' .
			// translators: Authors Stats: number of author posts
			_n( '%s post', '%s posts', $author_posts_number, 'keitaro' ) . '</strong> ' . __( 'and', 'keitaro' ) . ' <strong>' .
			// translators: Authors Stats: number of author comments
			_n( '%s comment', '%s comments', $author_comments_number, 'keitaro' ) . '</strong> ' .
			// translators: Authors Stats: connector
			__( 'so far', 'keitaro' ) . '.</small></p>',
		$author_posts_number,
		$author_comments_number
		);

	$print .= sprintf(
		 '<h3 class="sr-only">%1$s</h3><div class="d-flex align-items-center author-box author vcard">%2$s<div class="author-info"><h4 class="author-title">%3$s</h4><p class="author-description">%6$s%4$s</p>%5$s</div></div>',
			// translators: Authors Stats: title
			__( 'Author', 'keitaro' ),
		sprintf(
					// translators: Authors Stats: author name
					'<div class="author-avatar">%2$s</div>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				keitaro_author_avatar( $author, ( is_single() ? 96 : 112 ), false )
				),
		$author_title,
		$author_description,
		$author_stats,
		( ! empty( $author_work_position ) ? '<p class="work-position"><strong>' . $author_work_position . '</strong> ' . sprintf( '%s %s', __( 'at', 'keitaro' ), get_bloginfo( 'title' ) ) . '.</p>' : '' )
	);

	if ( true === $display ) :
		echo wp_kses_post( $print );
	else :
		return wp_kses_post( $print );
	endif;

}

function keitaro_author_avatar( $author = false, $size = 112, $display = true ) {

	$print = '';

	$custom_avatar_url  = wp_get_attachment_image_url( get_the_author_meta( 'user_meta_image', $author ) );
	$default_avatar_url = get_avatar_url( '', array( 'size' => $size ) );
	$custom_avatar      = sprintf( '<img alt="Author avatar" src="%1$s" class="avatar avatar-96 photo avatar-default" height="%2$s" width="%2$s">', $custom_avatar_url, $size );

	if ( $custom_avatar_url ) :
		$avatar = $custom_avatar;
	elseif ( $custom_avatar_url === $default_avatar_url ) :
		$avatar = $custom_avatar;
	else :
		$avatar = get_avatar( $author, $size );
	endif;

	$print .= sprintf( '<a title="%1$s" class="avatar-url url fn n" href="%2$s">%3$s</a>', get_the_author_meta( 'display_name', $author ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), $avatar );

	if ( true === $display ) :
		echo wp_kses_post( $print );
	else :
		return wp_kses_post( $print );
	endif;

}

function keitaro_posted_on() {
	the_date( '', '<p>', '</p>' );

}

function keitaro_read_more( $class = 'btn-secondary' ) {
	wp_kses(
		printf(
		 '<a class="%4$s text-white btn btn-sm btn-read-more" href="%1$s" title="%2$s">%3$s</a>',
			 esc_url( get_permalink() ),
			 sprintf( esc_html__( 'Continue reading', 'keitaro' ) . ' %s', get_the_title() ),
			 esc_html__( 'Read more', 'keitaro' ),
			 esc_html( $class )
			),
		array(
			'a' => array(
				'class' => array(),
				'href'  => array(),
				'title' => array(),
			),
		)
		);

}

// Wrap text in highlight wrapper
function highlight( $text ) {
	return sprintf( '<span class="highlight">%s</span>', $text );

}

function keitaro_go_to_top_link( $link_title ) {
	printf( '<a class="btn btn-go-to-top btn-info text-white"><span class="fa fa-fw fa-caret-up"></span></a>', esc_html( $link_title ) );

}

function keitaro_continue_to_second_blog_posts_page_button( $text, $link ) {
	$link = get_post_type_archive_link( 'post' ) . 'page/2/';
	printf( '<div class="call-to-action-secondary text-center"><a class="btn btn-success" href="%2$s">%1$s</a></div>', esc_html( $text ), esc_url( $link ) );

}

/* Support custom profile pictures in case avatars
 * are not available through Gravatar */

function keitaro_custom_profile_data( $user ) {

	if ( current_user_can( 'upload_files', $user->ID ) ) :
		wp_enqueue_media();
		wp_enqueue_script( 'keitaro-custom-profile-picture', get_stylesheet_directory_uri() . '/assets/js/custom-profile-picture.js' );

		// Get thumbnail version of the current attachment
		$current_profile_picture_id = get_the_author_meta( 'user_meta_image', $user->ID );
		$current_profile_picture    = wp_get_attachment_image_url( $current_profile_picture_id );

		if ( empty( $current_profile_picture_id ) ) :
			$current_profile_picture = get_avatar_url( '' );
		endif;
	endif;

	if ( current_user_can( 'edit_posts', $user->ID ) ) :
		$current_work_position = get_the_author_meta( 'user_work_position', $user->ID );
	endif;

	?>

	<?php if ( current_user_can( 'edit_posts', $user->ID ) ) : ?>
		<h3><?php esc_html_e( 'Additional Options', 'keitaro' ); ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="user_work_position"><?php esc_html_e( 'Work Position', 'keitaro' ); ?></label></th>
				<td>
					<input type="text" name="user_work_position" id="user_work_position" placeholder="Web Developer" class="regular-text" value="<?php echo esc_attr( $current_work_position ); ?>">
				</td>
			</tr>
			<?php if ( current_user_can( 'upload_files', $user->ID ) ) : ?>
				<tr>
					<th><label for="user_meta_image"><?php esc_html_e( 'Custom Profile Picture', 'keitaro' ); ?></label></th>
					<td>
						<a href="javascript:;" class="custom-profile-picture">
							<img class="current-profile-picture" src="<?php echo esc_url( $current_profile_picture ); ?>" width="96"><br />
						</a>
						<p class="description"><?php esc_html_e( 'Set a custom picture for your user profile to replace your currently-used one or the default Gravatar &mdash; useful when an email address is not associated with an existing Gravatar profile.', 'keitaro' ); ?></p>
						<p>
							<button type='button' class="button custom-profile-picture"><?php echo ( empty( $current_profile_picture_id ) ? esc_html__( 'Upload Image', 'keitaro' ) : esc_html__( 'Replace Image', 'keitaro' ) ); ?></button>
							<?php if ( $current_profile_picture_id ) : ?>
								<button type="button" class="button custom-profile-picture-remove"><?php esc_html_e( 'Reset Image', 'keitaro' ); ?></button>
							<?php endif; ?>
						</p>
						<input type="hidden" name="user_meta_image" id="user_meta_image" value="<?php echo esc_attr( $current_profile_picture_id ); ?>" class="regular-text" />
					</td>
				</tr>
			<?php endif; ?>
		</table><!-- end form-table -->
		<?php

	endif;

}

// additional_user_fields

add_action( 'show_user_profile', 'keitaro_custom_profile_data' );
add_action( 'edit_user_profile', 'keitaro_custom_profile_data' );

function keitaro_custom_image_placeholder( $attachment_id, $display = true, $print = '' ) {

	if ( $attachment_id ) :
		$btn_label_add    = __( 'Replace Image', 'keitaro' );
		$btn_label_remove = __( 'Remove Image', 'keitaro' );
		$custom_image_url = esc_url( wp_get_attachment_image_url( $attachment_id ) );
	else :
		$btn_label_add    = __( 'Upload Image', 'keitaro' );
		$custom_image_url = get_avatar_url( '' );
	endif;

	if ( $display ) :
		$print .= sprintf( '<div><a data-media-widget-title="%1$s" href="#" class="custom-image"><img class="current-custom-image" src="%2$s" width="96"></a></div>', $btn_label_add, $custom_image_url );
		$print .= sprintf( '<button data-media-widget-title="%1$s" type="button" class="button custom-image">%1$s</button>&nbsp;', $btn_label_add );
		if ( $attachment_id ) :
			$print .= sprintf( '<button data-media-widget-title="%1$s" type="button" class="button custom-image-remove">%1$s</button>', $btn_label_remove );
		endif;

		echo wp_kses_post( $print );
	else :
		return esc_url( $custom_image_url );
	endif;

}

/**
 * Saves additional user fields to the database
 */
function keitaro_save_work_position( $user_id ) {

	// only saves if the current user can edit user profiles
	if ( ! current_user_can( 'edit_posts', $user_id ) && ! wp_verify_nonce( 'update-user_' . $user_id ) ) :
		return false;
	endif;

	update_user_meta( $user_id, 'user_work_position', esc_attr( $_POST['user_work_position'] ) );

}

add_action( 'personal_options_update', 'keitaro_save_work_position' );
add_action( 'edit_user_profile_update', 'keitaro_save_work_position' );

/**
 * Saves additional user fields to the database
 */
function keitaro_save_custom_profile_picture( $user_id ) {

	// only saves if the current user can edit user profiles
	if ( ! current_user_can( 'upload_files', $user_id ) && ! wp_verify_nonce( 'update-user_' . $user_id ) ) :
		return false;
	endif;

	update_user_meta( $user_id, 'user_meta_image', esc_attr( $_POST['user_meta_image'] ) );

}

add_action( 'personal_options_update', 'keitaro_save_custom_profile_picture' );
add_action( 'edit_user_profile_update', 'keitaro_save_custom_profile_picture' );

/*
 * Remove Jetpack CSS assets
 */

add_filter( 'jetpack_implode_frontend_css', '__return_false' );

function keitaro_remove_jetpack_css() {
	wp_deregister_style( 'grunion.css' ); // Grunion contact form

}

add_action( 'wp_enqueue_scripts ', 'keitaro_remove_jetpack_css' );

/**
 * Show search results only within posts
 *
 * @param object $query
 * @return $query
 */
function keitaro_search_posts_only( $query ) {
	if ( $query->is_main_query() && is_search() ) {
		$query->set( 'post_type', 'post' );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'keitaro_search_posts_only' );

/*
 * Allow file uploads by users with Contributor role
 */
if ( current_user_can( 'contributor' ) && ! current_user_can( 'upload_files' ) ) {
	add_action( 'admin_init', 'keitaro_allow_contributor_uploads' );
}

function keitaro_allow_contributor_uploads() {
	$contributor = get_role( 'contributor' );
	$contributor->add_cap( 'upload_files' );

}

// Remove emoji prefetch links and inline scripts from <head>
add_filter( 'emoji_svg_url', '__return_false' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Based on https://www.binarymoon.co.uk/2010/03/akismet-plugin-theme-stop-spam-dead/
 *
 * @param [type] $content
 * @return void
 */
function keitaro_akismet_check_spam( $content ) {

	// innocent until proven guilty
	$isSpam = false;

	$content = (array) $content;

	if ( function_exists( 'akismet_init' ) ) {

		$wpcom_api_key = get_option( 'wordpress_api_key' );

		if ( ! empty( $wpcom_api_key ) ) {

			global $akismet_api_host, $akismet_api_port;

			// set remaining required values for akismet api
			$content['user_ip'] = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
			$content['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$content['referrer'] = $_SERVER['HTTP_REFERER'];
			$content['blog'] = get_option( 'home' );

			if ( empty( $content['referrer'] ) ) {
				$content['referrer'] = get_permalink();
			}

			$queryString = '';

			foreach ( $content as $key => $data ) {
				if ( ! empty( $data ) ) {
					$queryString .= $key . '=' . urlencode( stripslashes( $data ) ) . '&';
				}
			}

			$response = akismet_http_post( $queryString, $akismet_api_host, '/1.1/comment-check', $akismet_api_port );

			if ( $response[1] == 'true' ) {
				// update_option('akismet_spam_count', get_option('akismet_spam_count') + 1);
				$isSpam = true;
			}
}
}

	return $isSpam;

}
