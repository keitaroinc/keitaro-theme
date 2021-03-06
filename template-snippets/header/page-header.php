<?php
/**
 * Template snippet for .page-header
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$page_title    = '';
$page_subtitle = '';

if ( is_author() ) :
	$page_title = __( 'Content by:', 'keitaro' );

elseif ( is_search() ) :
	global $wp_query;
	$page_title    = __( 'Search results:', 'keitaro' ) . ' ' . highlight( get_search_query() );
	$page_subtitle = __( 'Found', 'keitaro' ) . ' ' . highlight( $wp_query->found_posts ) . ' ' . __( 'search results', 'keitaro' );

elseif ( is_archive() ) :
	$page_title = get_the_archive_title();

endif;

if ( ! empty( $page_title ) ) :

	?>
	<header class="page-header">
		<div class="row">
			<div class="col-md-8">
				<?php if ( $page_title ) : ?>
							<h1 class="page-title"><?php echo wp_kses_post( $page_title ); ?></h1>
				<?php endif; ?>
				<?php if ( $page_subtitle ) : ?>
					<p class="lead"><?php echo wp_kses_post( $page_subtitle ); ?></p>
					<?php

				endif;

if ( is_author() ) :
	keitaro_author_box( get_the_author_meta( 'ID' ) );
				endif;

				?>
			</div>
		</div>
	</header>
	<?php
endif;
