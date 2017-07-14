<?php

define('SNIPPETS_DIR', 'template-snippets');

// Initialize theme
function keitaro_theme_setup() {

	// require_once dirname(__FILE__) . '/inc/theme-settings.php';
	// Load text domain for localization
	load_theme_textdomain('keitaro');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	add_image_size('keitaro-featured-image', 2000, 1200, true);
	add_image_size('keitaro-thumbnail-avatar', 100, 100, true);

	// Set the default content width.
	$GLOBALS['content_width'] = 960;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(array(
		'main' => __('Main Menu', 'keitaro'),
		'footer' => __('Footer Menu'),
		'social' => __('Social Links', 'keitaro'),
		'footer-secondary' => __('Secondary Footer Menu', 'keitaro'),
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
		'comment-form',
		'comment-list',
		'search-form',
		'gallery',
		'caption',
	));

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	));

	// Add theme support for Custom Logo.
	add_theme_support('custom-logo', array(
		'flex-width' => true,
		'height' => 100,
	));

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	// Add theme support for custom headers
//    add_theme_support('custom-header', array(
//        'default-image' => get_stylesheet_directory_uri() . '/assets/img/keitaro-hero-bg.png',
//        'flex-height' => true,
//        'flex-width' => true,
//    ));

}

add_action('after_setup_theme', 'keitaro_theme_setup');

// Add static CSS and JS theme assets
function keitaro_theme_scripts() {

	// Futura PT font from Typekit
	wp_enqueue_script('futura-pt', get_stylesheet_directory_uri() . '/assets/js/futura-pt.js');

	// Main keitaro_theme stylesheet
	wp_enqueue_style('keitaro-theme-style', get_stylesheet_uri());

	// jQuery
	wp_enqueue_script('jquery');

	// Bootstrap JS modules
	wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js');

}

add_action('wp_enqueue_scripts', 'keitaro_theme_scripts');

// Add favicon links to <head>
function keitaro_theme_favicons() {

	?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri() . '/assets/img/keitaro-favicon-32x32.png' ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri() . '/assets/img/keitaro-favicon-144x144.png' ?>">
	<?php

}

add_action('wp_head', 'keitaro_theme_favicons');

// Override default WordPress logo on wp-login.php
function keitaro_theme_login_logo() {

	$custom_logo_id = get_theme_mod('custom_logo');
	$image = wp_get_attachment_image_src($custom_logo_id, 'full');

	?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo $image[0]; ?>);
			width:225px;
			height:auto;
			background-size: 225px auto;
			background-repeat: no-repeat;
			padding-bottom: 30px;
		}
	</style>
	<?php

}

add_action('login_enqueue_scripts', 'keitaro_theme_login_logo');

// Require Keitaro Service widget
require_once SNIPPETS_DIR . '/widgets/class-wp-widget-service.php';

// Require Keitaro Call to Action widget
require_once SNIPPETS_DIR . '/widgets/class-wp-widget-call-to-action.php';

// Require Keitaro Call to Action widget
require_once SNIPPETS_DIR . '/widgets/class-wp-widget-icon-block.php';

// Require Twitter Grid widget
require_once SNIPPETS_DIR . '/widgets/class-wp-widget-twitter-grid.php';

// Register Widget areas
function keitaro_widgets_init() {

	register_sidebar(array(
		'name' => __('Services', 'keitaro'),
		'id' => 'keitaro_services',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<span class="service-title">',
		'after_title' => '</span>',
	));

	register_sidebar(array(
		'name' => __('Service Icons', 'keitaro'),
		'id' => 'keitaro_service_icons',
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name' => __('Call to Action', 'keitaro'),
		'id' => 'keitaro_call_to_action',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="call-to-action-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Page Icon Blocks', 'keitaro'),
		'id' => 'keitaro_page_icon_blocks',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="page-icon-blocks-title">',
		'after_title' => '</h3>',
	));
    
	register_sidebar(array(
		'name' => __('Twitter Content', 'keitaro'),
		'id' => 'keitaro_twitter_content',
		'before_widget' => '<div class="twitter-content-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="twitter-content-widget-title text-center">',
		'after_title' => '</h2>',
	));

	if (class_exists('Keitaro_Service')):
		register_widget('Keitaro_Service');
	endif;

	if (class_exists('Keitaro_Call_To_Action')):
		register_widget('Keitaro_Call_To_Action');
	endif;

	if (class_exists('Keitaro_Icon_Block')):
		register_widget('Keitaro_Icon_Block');
	endif;
	
	if (class_exists('Keitaro_Tweets')):
		register_widget('Keitaro_Tweets');
	endif;

}

add_action('widgets_init', 'keitaro_widgets_init');


// Shortcode to modify hero title to show first three words in bold
add_shortcode('keitaro-hero-title', 'keitaro_hero_title_shortcode');

function keitaro_hero_title_shortcode() {

	$title = get_bloginfo('description');
	$formatted_title = explode(' ', $title);
	$formatted_title[2] = $formatted_title[2] . '<span class="hero-subtitle">';
	printf('<h2 class="hero-title">%s</h2>', implode(' ', $formatted_title));

}

/*
 * Generate navigation menu for a predefined/registered menu location
 */

function keitaro_menu($menu_location, $menu_class = '') {

	if (has_nav_menu($menu_location)) :

		?>
		<nav id="site-navigation" role="navigation" aria-label="<?php esc_attr_e('Main Menu', 'keitaro'); ?>">
			<?php

			wp_nav_menu(array(
				'theme_location' => $menu_location,
				'container' => 'ul',
				'menu_id' => $menu_location . '-menu',
				'menu_class' => $menu_location . '-navigation list-inline ' . $menu_class,
			));

			?>
		</nav>
		<?php

	endif;

}

/*
 * Override default link of the login form logo
 */

function keitaro_login_logo_url() {
	return home_url();

}

add_filter('login_headerurl', 'keitaro_login_logo_url');

/*
 * Override default title attribute of the login form logo
 */

function keitaro_login_logo_url_title() {
	return get_bloginfo('name') . ' - ' . get_bloginfo('description');

}

add_filter('login_headertitle', 'keitaro_login_logo_url_title');

function keitaro_child_pages_list($parent_page_id) {
	$child_pages = get_children(
			array(
				'post_parent' => $parent_page_id,
				'post_type' => 'page',
				'order' => 'ASC',
				'orderby' => 'menu_order',
			)
	);

	if ($child_pages) :

		?>
		<div class="service-list">
			<?php foreach ($child_pages as $page) : ?>
				<h4 class="service-list-item"><a href="<?php the_permalink($page->ID); ?>"><?php echo $page->post_title; ?></a></h4>
				<?php endforeach; ?>
		</div>
		<?php

	endif;

}

function keitaro_author_box($author = false, $display = true) {

	$print = '';
	$author_title = get_the_author_posts_link($author);
	$author_description = '';
	$author_stats = sprintf('<p class="author-stats">' . __('Contributed', 'keitaro') . ' <strong>%s</strong> %s.</p>', get_the_author_posts($author), __('posts so far', 'keitaro'));

	if (is_single() || is_author()) :
		$author_description = get_the_author_meta('description');
	endif;

	$print .= sprintf('<h3 class="sr-only">%1$s</h3><div class="author-box">%2$s<h4 class="author-title">%3$s</h4><p class="author-description">%4$s</p>%5$s</div>', __('Author', 'keitaro'), sprintf(
					__('%s', 'twentyseventeen'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . get_avatar($author) . '</a></span>'), $author_title, $author_description, $author_stats
	);

	if ($display == true) {
		echo $print;
	} else {
		return $print;
	}

}

function keitaro_posted_on() {

	the_date(get_option('date_format'), '<p>', '</p>');

}
