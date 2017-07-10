<div class="entry-content">
    <?php

    if (is_page()):
        echo apply_filters('the_content', $post->post_content);
    else:
        the_content();
    endif;

    wp_link_pages(array(
        'before' => '<div class="page-links">' . sprintf('<h3>%s</h3>', __('Page', 'keitaro')),
        'after' => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after' => '</span>',
    ));

    ?>
</div><!-- .entry-content -->