<header class="entry-header">
    <?php

    the_title('<h4 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h4>');

    if ('post' === get_post_type()) {
        echo '<div class="entry-meta">';
        if (is_single() || is_archive() || is_home()) {
            keitaro_posted_on();
        }
        echo '</div><!-- .entry-meta -->';
    };

    ?>
</header>
