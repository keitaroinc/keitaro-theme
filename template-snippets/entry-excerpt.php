<?php

$is_first_post = false;

if ($wp_query->current_post < 1):
    $is_first_post = true;
endif;

?>
<div class="entry-content">
    <?php

    /* translators: %s: Name of current post */
    echo apply_filters('the_excerpt', get_the_excerpt());

    if ($is_first_post):
        keitaro_read_more('btn-success');
    else:
        keitaro_read_more();
    endif;

    wp_link_pages(array(
        'before' => '<div class="page-links">' . sprintf('<h3>%s</h3>', __('Page', 'keitaro')),
        'after' => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after' => '</span>',
    ));

    ?>
</div><!-- .entry-content -->
