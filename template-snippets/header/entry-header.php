<header class="entry-header">
    <?php

    if (is_single()) {
        the_title('<h1 class="entry-title">', '</h1>');
    } elseif (is_front_page() && is_home()) {
        the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
    } elseif (is_page_template('page-parent.php') && empty(get_the_content())) {
        // Don't render the title if content is empty on pages with the Parent Page template applied
    } else {
        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
    }

    if ('post' === get_post_type()) {
        echo '<div class="entry-meta">';
        if (is_single() || is_archive() || is_home()) {
            keitaro_posted_on();
        }
        echo '</div><!-- .entry-meta -->';
    };

    ?>
</header>
