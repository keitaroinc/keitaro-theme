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
define( 'DEFAULT_OG_IMAGE_URL', get_stylesheet_directory_uri() . '/assets/img/keitaro-default-og-photo-1200x630.jpg' );

/**
 * Initialize WordPress theme
 *
 * @return void
 */
function keitaro_theme_setup() {

	/**
	 * Remove WordPress version meta tag
	 */
	add_filter( 'the_generator', '__return_false' );

	/**
	 * Register Custom Headers
	 */
	register_default_headers(
		array(
			'keitaro' => array(
				'url'           => DEFAULT_HEADER_IMAGE,
				'thumbnail_url' => DEFAULT_HEADER_IMAGE,
				'description'   => __( 'The default hero image of Keitaro Inc.', 'keitaro' ),
			),
		)
	);

	require_once __DIR__ . '/' . SNIPPETS_DIR . '/class-keitaro-theme-settings.php';

	/**
	 * Load text domain for localization
	 */
	load_theme_textdomain( 'keitaro' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Video support for Custom Header
	 */
	add_theme_support(
		'custom-header',
		array(
			'video' => true,
		)
	);

	/**
	 * Custom gradient presets for Gutenberg
	 */
	add_theme_support(
		'editor-gradient-presets',
		array(
			array(
				'name'     => __( 'Green to Light Gray', 'keitaro' ),
				'gradient' => 'linear-gradient(180deg, #1e9843 0% 65%, #f2f2f2 65%)',
				'slug'     => 'green-to-light-gray',
			),
			array(
				'name'     => __( 'Green to White', 'keitaro' ),
				'gradient' => 'linear-gradient(180deg, #1e9843 0% 65%, #fff 65%)',
				'slug'     => 'green-to-white',
			),
			array(
				'name'     => __( 'Light Gray to White', 'keitaro' ),
				'gradient' => 'linear-gradient(180deg, #f2f2f2 0% 65%, #fff 65%)',
				'slug'     => 'light-gray-to-white',
			),
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Add support for excerpts on Pages
	 */
	add_post_type_support( 'page', 'excerpt' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'keitaro-featured-image', 1920, 1200, true );
	add_image_size( 'keitaro-thumbnail-avatar', 100, 100, true );

	/**
	 * Set the default content width
	 */
	$GLOBALS['content_width'] = 960;

	/**
	 * Register navigation menus
	 */
	register_nav_menus(
		array(
			'main'             => __( 'Main Menu', 'keitaro' ),
			'footer'           => __( 'Footer Menu' ),
			'social'           => __( 'Social Links', 'keitaro' ),
			'footer-secondary' => __( 'Secondary Footer Menu', 'keitaro' ),
			'footer-services'  => __( 'Services Menu', 'keitaro' ),
			'footer-products'  => __( 'Products Menu', 'keitaro' ),
			'footer-offices'   => __( 'Offices Menu', 'keitaro' ),
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
			'script',
			'style',
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

	/**
	 * Add theme support for Custom Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'flex-width' => true,
			'height'     => 100,
		)
	);

	/**
	 * Add theme support for selective refresh for widgets
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add theme support for custom headers
	 */
	add_theme_support(
		'custom-header',
		array(
			'default-image' => DEFAULT_HEADER_IMAGE,
			'flex-height'   => true,
			'flex-width'    => true,
		)
	);

	/**
	 * Additional styles for Gutenberg
	 */
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-spacing' );
	add_theme_support( 'custom-units' );

	/**
	 * Support Full and Wide alignment in Gutenberg
	 */
	add_theme_support( 'align-wide' );

	// $starter_content = array();
	// add_theme_support( 'starter-content', $starter_content );

	register_meta(
		'user',
		'user_meta_image',
		array(
			'default'      => 1,
			'single'       => true,
			'description'  => 'Custom Profile Picture',
			'type'         => 'integer',
		)
	);

	/*
	* Allow file uploads by users with Contributor role
	*/
	$user = wp_get_current_user();
	if ( in_array( 'contributor', (array) $user->roles ) && ! current_user_can( 'upload_files' ) ) {
		add_action( 'admin_init', 'keitaro_allow_contributor_uploads' );
	}

	keitaro_add_former_employee_role();
}

add_action( 'after_setup_theme', 'keitaro_theme_setup' );

/**
 * Add Former Employee option to Role select
 *
 * @return void
 */
function keitaro_add_former_employee_role() {
	$roles_set = get_option( 'former_employee_role_set' );

	if ( ! $roles_set ) {
		add_role(
			'former_employee',
			'Former Employee',
			array(
				'read' => true, // True allows that capability, False specifically removes it.
				'upload_files' => true,
			)
		);
		update_option( 'former_employee_role_set', true );
	}
}

/**
 * Customize excerpt length
 *
 * @param integer $length Excerpt length in number of characters.
 * @return integer
 */
function custom_excerpt_length( $length ) {
	return 30;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Customize excerpt more content
 *
 * @param string $more Content of the more placeholder.
 * @return string
 */
function custom_excerpt_more( $more ) {
	return '...';
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );

/**
 * Enqueue custom Gutenberg assets to set and/or override styles, functionalities and more.
 */
function gutenberg_assets() {
	wp_enqueue_script(
		'gutenberg-overrides',
		get_stylesheet_directory_uri() . '/assets/js/gutenberg-overrides.min.js',
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
		filemtime( get_stylesheet_directory() . '/assets/js/gutenberg-overrides.min.js' )
	);
}

add_action( 'enqueue_block_editor_assets', 'gutenberg_assets' );

/**
 * Set custom meta descriptions
 *
 * @return void
 */
function custom_meta_descriptions() {

	// Reset post data to the post in the main query.
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

/**
 * Set custom meta tags for Open Graph
 *
 * @return void
 */
function open_graph_tags() {
	?>
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@KeitaroInc">
	<meta name="twitter:creator" content="@KeitaroInc">
	<meta name="og:title" content="<?php echo esc_attr( get_bloginfo( 'name' ) ) . wp_title( '&#8211;', false ); ?>">
	<?php
	/**
	 * By default, featured images are used with the og:image and twitter:image tags.
	 * If no Featured image is set, the src of the first <img /> tag in the content is used.
	 */
	if ( get_the_post_thumbnail() ) :
		?>
		<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>" />
	<?php else : ?>
		<?php if ( is_front_page() ) : ?>
			<meta property="og:image" content="<?php echo esc_url( DEFAULT_OG_IMAGE_URL ); ?>" />
		<?php else : ?>
			<meta property="og:image" content="<?php echo ! empty( extract_featured_image() ) ? esc_url( extract_featured_image() ) : esc_url( DEFAULT_OG_IMAGE_URL ); ?>" />
			<?php
		endif;
	endif;
}
add_action( 'wp_head', 'open_graph_tags' );

/**
 * Create Showcases content type
 *
 * @return void
 */
function custom_post_type_showcases() {
	$labels = array(
		'name'               => _x( 'Showcases', 'Post Type General Name', 'keitaro' ),
		'singular_name'      => _x( 'Showcase', 'Post Type Singular Name', 'keitaro' ),
		'menu_name'          => __( 'Showcases', 'keitaro' ),
		'all_items'          => __( 'All Showcases', 'keitaro' ),
		'view_item'          => __( 'View Showcase', 'keitaro' ),
		'add_new_item'       => __( 'Add New Showcase', 'keitaro' ),
		'add_new'            => __( 'Add New', 'keitaro' ),
		'edit_item'          => __( 'Edit Showcase', 'keitaro' ),
		'update_item'        => __( 'Update Showcase', 'keitaro' ),
		'search_items'       => __( 'Search Showcases', 'showcases' ),
		'not_found'          => __( 'Not Found', 'keitaro' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'keitaro' ),
	);

	$args = array(
		'label'        => __( 'Showcases', 'keitaro' ),
		'description'  => __( 'Custom post type for Showcases ', 'keitaro' ),
		'labels'       => $labels,
		// Features this CPT supports in Post Editor.
		'supports'     => array( 'title', 'editor', 'trackbacks', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields' ),
		// CPT taxonomies.
		'taxonomies'   => array( 'category', 'post_tag' ),
		'public'       => true,
		'has_archive'  => true,
		'show_in_rest' => true,

	);

	register_post_type( 'showcases', $args );
}

add_action( 'init', 'custom_post_type_showcases' );

/**
 * Set custom meta tag for Google Search Console
 *
 * @return void
 */
function google_search_console_tags() {
	 $gsc_verification_id = get_option( 'keitaro_settings' )['gsc_verification_id'] ?? false;

	if ( $gsc_verification_id ) :
		printf( '<meta name="google-site-verification" content="%s" />', esc_html( $gsc_verification_id ) );
	endif;
}

add_action( 'wp_head', 'google_search_console_tags' );

/**
 * CSS overrides to WordPress Block styles
 *
 * @return void
 */
function wp_block_overrides() {
	 wp_enqueue_style( 'wp-block-overrides', get_stylesheet_directory_uri() . '/assets/css/wp-block.css', null, filemtime( get_stylesheet_directory() . '/assets/css/wp-block.css' ) );
}

// Override the appearance of the Gutenberg block editor.
add_action( 'admin_enqueue_scripts', 'wp_block_overrides' );

/**
 * Set custom script for Metricool
 *
 * @return void
 */
function metricool_hash() {
	 $metricool_verification_hash_id = get_option( 'keitaro_settings' )['metricool_verification_hash_id'];

	if ( $metricool_verification_hash_id ) :
		printf( '<script>function loadScript(a){var b=document.getElementsByTagName("head")[0],c=document.createElement("script");c.type="text/javascript",c.src="https://tracker.metricool.com/resources/be.js",c.onreadystatechange=a,c.onload=a,b.appendChild(c)}loadScript(function(){beTracker.t({hash:"%s"})});</script>', esc_html( $metricool_verification_hash_id ) );
	endif;
}

add_action( 'wp_head', 'metricool_hash' );

/**
 * Add static CSS and JS theme assets
 *
 * @return void
 */
function keitaro_theme_scripts() {

	// Futura PT font from Typekit.
	wp_enqueue_script( 'futura-pt', get_stylesheet_directory_uri() . '/assets/js/futura-pt.min.js', null, filemtime( get_stylesheet_directory() . '/assets/js/futura-pt.min.js' ), true );

	// Main keitaro_theme stylesheet.
	wp_enqueue_style( 'keitaro-theme', get_stylesheet_uri(), null, filemtime( get_stylesheet_directory() . '/style.css' ) );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Bootstrap JS modules.
	wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', null, filemtime( get_stylesheet_directory() . '/assets/js/bootstrap.min.js' ), true );

	// Custom JS minified.
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.min.js', null, filemtime( get_stylesheet_directory() . '/assets/js/custom.min.js' ), true );

	// Prism.js - load only for pages, posts and custom post types.
	if ( is_singular() && ! is_page() ) :
		// Main keitaro_theme stylesheet.
		wp_enqueue_style( 'prism-css', get_stylesheet_directory_uri() . '/assets/css/prism-okaidia.css', null, filemtime( get_stylesheet_directory() . '/assets/css/prism-okaidia.css' ) );
		wp_enqueue_style( 'prism-toolbar-css', get_stylesheet_directory_uri() . '/assets/css/prism-toolbar.css', null, filemtime( get_stylesheet_directory() . '/assets/css/prism-toolbar.css' ) );
		wp_enqueue_script( 'clipboard-js', get_stylesheet_directory_uri() . '/assets/js/clipboard.min.js', null, filemtime( get_stylesheet_directory() . '/assets/js/clipboard.min.js' ), true );
		wp_enqueue_script( 'prism-js', get_stylesheet_directory_uri() . '/assets/js/prism.min.js', null, filemtime( get_stylesheet_directory() . '/assets/js/prism.min.js' ), true );
		wp_enqueue_script( 'prism-toolbar-js', get_stylesheet_directory_uri() . '/assets/js/prism-toolbar.min.js', null, filemtime( get_stylesheet_directory() . '/assets/js/prism-toolbar.min.js' ), true );
		wp_enqueue_script( 'prism-clipboard-js', get_stylesheet_directory_uri() . '/assets/js/prism-copy-to-clipboard.min.js', null, filemtime( get_stylesheet_directory() . '/assets/js/prism-copy-to-clipboard.min.js' ), true );
	endif;
}

add_action( 'wp_enqueue_scripts', 'keitaro_theme_scripts' );

add_action( 'wp_enqueue_scripts', 'keitaro_jquery_deregister' );

/**
 * Deregister default jQuery
 *
 * @return void
 */
function keitaro_jquery_deregister() {
	$jquery_path = '/assets/js/jquery.min.js';
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_bloginfo( 'template_url' ) . $jquery_path, null, filemtime( get_stylesheet_directory() . $jquery_path ), true );
}

/**
 * Override default WordPress logo on wp-login.php
 *
 * @return void
 */
function keitaro_theme_login_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );

	?>
	<style type="text/css">
		#login h1 a,
		.login h1 a {
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

/**
 * Register Widget areas
 *
 * @return void
 */
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
			'name'          => __( 'Footer Widgets Sidebar', 'keitaro' ),
			'description'   => __( 'Reserved for widgets shown in the footer of all pages', 'keitaro' ),
			'id'            => 'keitaro_footer_widgets',
			'before_widget' => '<div class="widget-wrapper %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Social Media Widgets Sidebar', 'keitaro' ),
			'description'   => __( 'Reserved for social media widgets shown in the footer of all pages', 'keitaro' ),
			'id'            => 'keitaro_social_media_widgets',
			'before_widget' => '<div class="widget-wrapper %2$s">',
			'after_widget'  => '</div>',
		)
	);
}

add_action( 'widgets_init', 'keitaro_widgets_init' );

/**
 * Add support for hyperlinks to default WordPress Image widget
 *
 * @param object $widget Current widget object.
 * @param array  $instance Current instance.
 * @return void
 */
function keitaro_add_media_image_url( $widget, $instance ) {

	// Are we dealing with a media_image widget?
	if ( 'media_image' === $widget->id_base ) {

		$handle = 'image_anchor_href';

		// Get already set hyperlink value or empty string.
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

/**
 * Generate navigation menu for a predefined/registered menu location
 *
 * @param string  $menu_location Menu location identifier.
 * @param string  $menu_class Menu class list.
 * @param string  $menu_id Menu identifier.
 * @param boolean $collapse Collapse toggle.
 * @return void
 */
function keitaro_menu( $menu_location, $menu_class = '', $menu_id = '', $collapse = false ) {

	if ( has_nav_menu( $menu_location ) ) :

		if ( ! $menu_id ) :
			$menu_id = uniqid( 'navbar-' );
		endif;

		?>
		<?php if ( $collapse ) : ?>
			<button type="button" title="<?php echo esc_attr( 'Toggle Menu', 'keitaro' ); ?>" class="navbar-toggler" data-toggle="collapse" data-target="#<?php echo esc_attr( $menu_id ); ?>" aria-expanded="false">
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

/**
 * Override default link of the login form logo
 *
 * @return string
 */
function keitaro_login_logo_url() {
	 return home_url();
}

add_filter( 'login_headerurl', 'keitaro_login_logo_url' );

/**
 * Override default title attribute of the login form logo
 *
 * @return string
 */
function keitaro_login_logo_url_title() {
	return get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' );
}

add_filter( 'login_headertitle', 'keitaro_login_logo_url_title' );

/**
 * Generate HTML element with a list of child pages of the specified parent page
 *
 * @param integer $parent_page_id Id of the parent page.
 */
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

/**
 * Generate HTML for author's box
 *
 * @param string  $author Author anchor with author name.
 * @param boolean $display Display or return toggle.
 * @param string  $print Output string.
 * @return string
 */
function keitaro_author_box( $author = false, $display = true, $print = '' ) {

	$author_title           = get_the_author_posts_link( $author );
	$author_description     = get_the_author_meta( 'description' );
	$author_posts_number    = get_the_author_posts( $author );
	$author_comments_number = count( get_comments( array( 'post_author' => $author ) ) );
	$author_work_position   = get_the_author_meta( 'user_work_position' );
	$author_stats           = sprintf(
		'<p class="author-stats mb-0"><small>' .
			// translators: Authors Stats: sentence.
			__( 'Contributed', 'keitaro' ) . ' <strong>' .
			// translators: Authors Stats: number of author posts.
			_n( '%s post', '%s posts', $author_posts_number, 'keitaro' ) . '</strong> ' . __( 'and', 'keitaro' ) . ' <strong>' .
			// translators: Authors Stats: number of author comments.
			_n( '%s comment', '%s comments', $author_comments_number, 'keitaro' ) . '</strong> ' .
			// translators: Authors Stats: connector.
			__( 'so far', 'keitaro' ) . '.</small></p>',
		$author_posts_number,
		$author_comments_number
	);

	$print .= sprintf(
		'<div class="row flex-xl-nowrap align-items-center justify-content-center no-gutters author-box author vcard"><div class="col-auto d-flex justify-content-center">%2$s</div><div class="col-sm"><div class="author-info"><h4 class="author-title">%3$s</h4>%6$s%4$s%5$s</div></div></div>',
		// translators: Authors Stats: title.
		__( 'Author', 'keitaro' ),
		sprintf(
			// translators: Authors Stats: author name.
			'<div class="author-avatar">%2$s</div>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			keitaro_author_avatar( $author, ( is_single() ? 96 : 112 ), false )
		),
		$author_title,
		! empty( $author_description ) ? sprintf( '<p class="author-description">%1$s</p>', $author_description ) : '',
		$author_stats,
		( ! empty( $author_work_position ) ? '<p class="work-position"><strong>' . $author_work_position . '</strong> ' . sprintf( '%s %s', __( 'at', 'keitaro' ), get_bloginfo( 'title' ) ) . '</p>' : '' )
	);

	if ( true === $display ) :
		echo wp_kses_post( $print );
	else :
		return wp_kses_post( $print );
	endif;
}

/**
 * Generate HTML for alternative author's box
 *
 * @param integer $author Author identifier.
 * @param boolean $display Display or return toggle.
 * @param string  $print Output string.
 * @return string
 */
function keitaro_author_box_alt( $author = false, $display = true, $print = '' ) {

	$user                   = get_userdata( $author );
	$author_posts           = get_the_author_posts_link( $author );
	$author_title           = sprintf( '%s %s', __( 'About', 'keitaro' ), get_the_author() );
	$author_description     = get_the_author_meta( 'description' );
	$author_work_position   = get_the_author_meta( 'user_work_position' );

	$print .= sprintf(
		'<div class="row no-gutters my-5 align-items-center author vcard"><div class="col-auto d-flex justify-content-center">%1$s</div><div class="col-lg-8 align-self-center"><div class="author-info"><h3 class="author-title mb-2">%2$s</h3>%3$s%4$s</div></div></div>',
		// translators: Authors Stats: title.
		sprintf(
			// translators: Authors Stats: author name.
			'<div class="author-avatar m-3 m-lg-4">%2$s</div>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			keitaro_author_avatar( $author, ( 112 ), false )
		),
		$author_title,
		! empty( $author_description ) && ! empty( $author_work_position ) ? '<p class="work-position"><strong>' . $author_work_position . '</strong> ' . sprintf( '%s %s', __( 'at', 'keitaro' ), get_bloginfo( 'title' ) ) . '</p>' : '',
		! empty( $author_description ) ? sprintf( '<p class="author-description mb-0">%s</p>', $author_description ) : ( ! empty( $author_work_position ) ? sprintf( '<p class="author-description mb-2"><strong>%1$s</strong> %2$s</p>', $author_work_position, sprintf( '%s %s', __( 'at', 'keitaro' ), get_bloginfo( 'title' ) ), $author_description ) : sprintf( '<p class="author-description mb-0">%1$s %2$s</p>', ! in_array( 'former_employee', (array) $user->roles ) ? sprintf( '%s %s', $author_posts, __( 'is part of', 'keitaro' ) ) : sprintf( '%s %s', $author_posts, __( 'was part of', 'keitaro' ) ), get_bloginfo( 'title' ) ) )
	);

	if ( true === $display ) :
		echo wp_kses_post( $print );
	else :
		return wp_kses_post( $print );
	endif;
}

/**
 * Generate HTML for author's avatar
 *
 * @param boolean $author Author identifier.
 * @param integer $size Avatar image size in pixels.
 * @param boolean $display Return or echo toggle.
 * @return string
 */
function keitaro_author_avatar( $author = false, $size = 70, $display = true ) {

	$print = '';

	$custom_avatar_url  = wp_get_attachment_image_url( get_the_author_meta( 'user_meta_image', $author ) );
	$default_avatar_url = get_avatar_url( '', array( 'size' => $size ) );
	$custom_avatar      = sprintf( '<img alt="Author avatar" src="%1$s" class="avatar avatar-96 photo avatar-default" height="%2$s" width="%2$s" />', $custom_avatar_url, $size );

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

/**
 * Print formatted post date in a <time> HTML element
 *
 * @return void
 */
function keitaro_posted_on() {
	the_date( '', '<time datetime="' . get_the_date( 'c' ) . '" itemprop="datePublished">', '</time>' );
}

/**
 * Wrap text in highlight wrapper
 *
 * @param string $text Text to be wrapped in the specified <span> HTML element.
 * @return string
 */
function highlight( $text ) {
	return sprintf( '<span class="highlight">%s</span>', $text );
}

/**
 * Prints out HTML for Go to Top anchor visible on every page
 *
 * @param string $link_title URL of the current page.
 */
function keitaro_go_to_top_link( $link_title ) {
	printf( '<a class="btn btn-go-to-top btn-info text-white"><span class="fa fa-fw fa-caret-up"></span></a>', esc_html( $link_title ) );
}

/**
 * Generate HTML for navigating to a next page
 *
 * @param string $text Anchor text.
 * @param string $link Anchor URL.
 * @return void
 */
function keitaro_continue_to_second_blog_posts_page_button( $text, $link ) {
	$link = get_post_type_archive_link( 'post' ) . 'page/2/';
	printf( '<div class="call-to-action-secondary text-center"><a class="btn btn-success" href="%2$s">%1$s</a></div>', esc_html( $text ), esc_url( $link ) );
}

/**
 *  Support custom profile pictures in case avatars are not available through Gravatar
 *
 * @param object $user Current user object.
 */
function keitaro_custom_profile_data( $user ) {

	if ( current_user_can( 'upload_files' ) ) :
		wp_enqueue_media();
		wp_enqueue_script( 'keitaro-custom-picture', get_stylesheet_directory_uri() . '/assets/js/custom-picture.min.js', null, filemtime( get_stylesheet_directory() . '/assets/js/custom-picture.min.js' ) );
		wp_create_nonce( 'update-user_' . $user->ID );

		// Get thumbnail version of the current attachment.
		$current_profile_picture_id = get_the_author_meta( 'user_meta_image', $user->ID );
		$current_profile_picture    = wp_get_attachment_image_url( $current_profile_picture_id );

		if ( empty( $current_profile_picture_id ) ) :
			$current_profile_picture = get_avatar_url( '' );
		endif;

	endif;

	if ( current_user_can( 'edit_posts' ) ) :
		$current_work_position = get_the_author_meta( 'user_work_position', $user->ID );
	endif;

	?>

	<?php if ( current_user_can( 'edit_posts' ) ) : ?>
		<h3><?php esc_html_e( 'Additional Options', 'keitaro' ); ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="user_work_position"><?php esc_html_e( 'Work Position', 'keitaro' ); ?></label></th>
				<td>
					<input type="text" name="user_work_position" id="user_work_position" placeholder="Web Developer" class="regular-text" value="<?php echo esc_attr( $current_work_position ); ?>">
					<p class="description"><?php esc_html_e( 'Work Position is automatically reset when the user is transitioned to the Former Employee role.', 'keitaro' ); ?></p>
				</td>
			</tr>
			<?php if ( current_user_can( 'upload_files' ) ) : ?>
				<tr>
					<th>
						<label for="user_meta_image"><?php esc_html_e( 'Custom Profile Picture', 'keitaro' ); ?></label>
					</th>
					<td>
						<button type="button" class="button button-link current custom-picture">
							<img class="current-picture" src="<?php echo esc_url( $current_profile_picture ); ?>" width="96" />
						</button>
						<p class="description"><?php esc_html_e( 'Set a custom picture for your user profile to replace your currently-used one or the default Gravatar &mdash; useful when an email address is not associated with an existing Gravatar profile.', 'keitaro' ); ?></p>
						<p>
							<button type='button' class="button custom-picture"><?php echo ( empty( $current_profile_picture_id ) ? esc_html__( 'Upload Image', 'keitaro' ) : esc_html__( 'Replace Image', 'keitaro' ) ); ?></button>
							<?php if ( $current_profile_picture_id ) : ?>
								<button type="button" class="button custom-picture-remove"><?php esc_html_e( 'Reset Image', 'keitaro' ); ?></button>
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

add_action( 'show_user_profile', 'keitaro_custom_profile_data' );
add_action( 'edit_user_profile', 'keitaro_custom_profile_data' );

/**
 * Saves additional user fields to the database
 *
 * @param integer $user_id Unique user identifier.
 */
function keitaro_save_work_position( $user_id ) {

	// only saves if the current user can edit user profiles.
	if ( ! current_user_can( 'edit_posts' ) && ! wp_verify_nonce( 'update-user_' . $user_id ) ) :
		return false;
	endif;

	update_user_meta( $user_id, 'user_work_position', esc_attr( isset( $_POST['user_work_position'] ) ? sanitize_text_field( wp_unslash( $_POST['user_work_position'] ) ) : null ) );
}

add_action( 'personal_options_update', 'keitaro_save_work_position' );
add_action( 'edit_user_profile_update', 'keitaro_save_work_position' );

/**
 * Reset the user work position when the user is added to the Former Employee group
 *
 * @param integer $user_id Unique user identifier.
 * @param string  $role Unique user role identifier.
 * @return void
 */
function keitaro_reset_work_position( $user_id, $role ) {

	if ( 'former_employee' === $role ) {
		update_user_meta( $user_id, 'user_work_position', esc_attr( '' ) );
	}
}

add_action( 'set_user_role', 'keitaro_reset_work_position', 10, 2 );

/**
 * Reset the user work position when the user profile is updated or viewed
 *
 * @param integer $user_id Unique user identifier.
 */
function keitaro_reset_work_position_on_update_profile( $user_id ) {

	$current_user = get_userdata( $user_id );

	if ( in_array( 'former_employee', (array) $current_user->roles ) ) {
		update_user_meta( $current_user->ID, 'user_work_position', esc_attr( '' ) );
	}
}

add_action( 'profile_update', 'keitaro_reset_work_position_on_update_profile' );

/**
 * Saves additional user fields to the database
 *
 * @param integer $user_id Unique user identifier.
 */
function keitaro_save_custom_profile_picture( $user_id ) {

	// Only save if the current user can edit user profiles.
	if ( ! current_user_can( 'upload_files' ) && ! wp_verify_nonce( 'update-user_' . $user_id ) ) :
		return false;
	endif;

	update_user_meta( $user_id, 'user_meta_image', esc_attr( isset( $_POST['user_meta_image'] ) ? sanitize_text_field( wp_unslash( $_POST['user_meta_image'] ) ) : '' ) );
}

add_action( 'personal_options_update', 'keitaro_save_custom_profile_picture' );
add_action( 'edit_user_profile_update', 'keitaro_save_custom_profile_picture' );


add_filter( 'jetpack_implode_frontend_css', '__return_false' );

/**
 * Remove Jetpack CSS assets
 *
 * @return void
 */
function keitaro_remove_jetpack_css() {
	 wp_deregister_style( 'grunion.css' ); // Grunion contact form.
}

add_action( 'wp_enqueue_scripts ', 'keitaro_remove_jetpack_css' );

/**
 * Show search results only within posts
 *
 * @param object $query WP_Query object.
 * @return $query
 */
function keitaro_search_posts_only( $query ) {
	if ( $query->is_main_query() && is_search() ) {
		$query->set( 'post_type', 'post' );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'keitaro_search_posts_only' );

/**
 * Allow file uploads by users with a Contributor role
 *
 * @return void
 */
function keitaro_allow_contributor_uploads() {
	$contributor = get_role( 'contributor' );
	$contributor->add_cap( 'upload_files' );
}

// Remove emoji prefetch links and inline scripts from <head>.
add_filter( 'emoji_svg_url', '__return_false' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Extract first image URL from content
 *
 * @return string
 */
function extract_featured_image() {
	 global $post, $posts;
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

	return $matches[1] ? $matches[1][0] : false;
}

/**
 * Remove default Jetpack og:image
 */
add_filter( 'jetpack_open_graph_image_default', '__return_false' );

/**
 * Remove Jetpack's default Open Graph tags
 */
add_filter( 'jetpack_enable_open_graph', '__return_false' );

/**
 * Register a 'Sales Tag' taxonomy for posts.
 *
 * @see register_post_type() for registering post types.
 */
function keitaro_register_sales_tag_taxonomy() {
	$labels = array(
		'name'              => _x( 'Sales Tags', 'taxonomy general name', 'keitaro' ),
		'singular_name'     => _x( 'Sales Tag', 'taxonomy singular name', 'keitaro' ),
		'search_items'      => __( 'Search Sales Tags', 'keitaro' ),
		'all_items'         => __( 'All Sales Tags', 'keitaro' ),
		'parent_item'       => __( 'Parent Sales Tag', 'keitaro' ),
		'parent_item_colon' => __( 'Parent Sales Tag:', 'keitaro' ),
		'edit_item'         => __( 'Edit Sales Tag', 'keitaro' ),
		'update_item'       => __( 'Update Sales Tag', 'keitaro' ),
		'add_new_item'      => __( 'Add New Sales Tag', 'keitaro' ),
		'new_item_name'     => __( 'New Genre Sales Tag', 'keitaro' ),
	);

	$args = array(
		'labels'             => $labels,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_admin_column'  => true,
		'query_var'          => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'show_in_quick_edit' => true,
		'show_in_rest'       => true,
		'rewrite'            => array( 'slug' => 'sales_tag' ),
	);

	register_taxonomy( 'sales-tag', 'post', $args );
}
add_action( 'init', 'keitaro_register_sales_tag_taxonomy' );

/**
 * Reset number of showcases per page to 9 on Showcases archive page
 *
 * @param object $query WP_Query object.
 * @return void
 */
function keitaro_showcases_per_page( $query ) {
	if ( $query->is_post_type_archive( 'showcases' ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 9 );
	}
}

add_action( 'pre_get_posts', 'keitaro_showcases_per_page' );
