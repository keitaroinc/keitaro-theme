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

	if ( is_post_type_archive() ) :
		$page_title = post_type_archive_title( '', false );
	else :
		$page_title = single_term_title( '', false );
		$page_subtitle = get_the_archive_description();
	endif;

elseif ( is_home() ) :
	$page_title = single_post_title( '', false );
endif;

if ( ! empty( $page_title ) ) :

	?>
	<header class="page-header">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<?php if ( $page_title ) : ?>
				<div class="row no-gutters align-items-center justify-content-center">
					<div class="col-auto">
						<h1 class="page-title"><?php echo wp_kses_post( $page_title ); ?></h1>
					</div>
					<?php
					if ( is_author() ) :
						?>
						<div class="col-lg col-xl-6 d-flex justify-content-center justify-content-lg-start">
						<?php keitaro_author_box( get_the_author_meta( 'ID' ) ); ?>
						</div>
						<?php
					endif;
					?>
				</div>
				<?php endif; ?>
				<?php if ( $page_subtitle ) : ?>
					<div class="lead"><?php echo wp_kses_post( $page_subtitle ); ?></div>
					<?php

				endif;

				?>
			</div>
		</div>
	</header>
	<?php
endif;
