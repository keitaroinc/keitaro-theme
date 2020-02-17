<?php
/**
 * Search form template
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only" for="<?php echo esc_attr( $unique_id ); ?>"><?php esc_attr_x( 'Search for:', 'label', 'keitaro' ); ?></label>

	<div class="input-group">
		<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'keitaro' ); ?>" required="required" value="<?php echo get_search_query(); ?>" name="s" />
		<span class="input-group-btn">
			<button type="submit" class="btn btn-outline-secondary"><span class="glyphicon glyphicon-search"></span></button>
		</span>
	</div>

</form>
