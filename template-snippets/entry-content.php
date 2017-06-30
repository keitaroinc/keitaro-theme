<div class="entry-content">
    <?php
    /* translators: %s: Name of current post */
    echo apply_filters('the_content', $post->post_content);
//                    the_content(sprintf(
//                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen'), get_the_title()
//                    ));

    wp_link_pages(array(
        'before' => '<div class="page-links">' . sprintf('<h3>%s</h3>', __('Page', 'twentyseventeen')),
        'after' => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after' => '</span>',
    ));
    ?>
</div><!-- .entry-content -->