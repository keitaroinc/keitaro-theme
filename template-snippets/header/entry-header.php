<?php

if (is_sticky() && is_home()) :
//		echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
endif;

?>
<header class="entry-header">
    <?php

    if (is_single()) {
        the_title('<h1 class="entry-title">', '</h1>');
    } elseif (is_front_page() && is_home()) {
        the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
    } else {
        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
    }

    if ('post' === get_post_type()) {
        echo '<div class="entry-meta">';
        if (is_single() || is_archive()) {
            keitaro_posted_on();
        } else {
//					echo twentyseventeen_time_link();
//					twentyseventeen_edit_link();
        };
        echo '</div><!-- .entry-meta -->';
    };

    ?>
</header>