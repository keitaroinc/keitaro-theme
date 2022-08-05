<?php

/**
 * Template snippet for the Sales form section
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */
?>

<?php

$tag_id = 'sales-tag';

if (get_the_terms(get_the_ID(), $tag_id)) : ?>
	<section class="my-5">
		<?php the_terms(get_the_ID(), $tag_id, '<h2 class="text-center has-text-align-center">How may we help you with ', ' / ', '?</h2>'); ?>
	</section>
<?php endif; ?>
