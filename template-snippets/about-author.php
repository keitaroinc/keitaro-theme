<?php

/**
 * Template snippet for the author of each post
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */
?>

<div class="row">
	<div class="col-sm-10 offset-sm-1 col-lg-8 offset-lg-2">
		<?php keitaro_author_box_alt( get_the_author_meta( 'ID' ) ); ?>
	</div>
</div>
