<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <div class="col-md-4">
            <?php

            if ('' !== get_the_post_thumbnail() && !is_single()) :
                get_template_part(SNIPPETS_DIR . '/post-thumbnail');
            endif;

            keitaro_child_pages_list(get_the_ID());

            get_template_part(SNIPPETS_DIR . '/sidebars/locations');

            ?>
        </div>
        <div class="col-md-6">
            <?php

            if (get_the_content()):
                get_template_part(SNIPPETS_DIR . '/header/entry-header');
                get_template_part(SNIPPETS_DIR . '/entry-content');
            endif;
            get_template_part(SNIPPETS_DIR . '/sidebars/contact-form');

            ?>
        </div>
    </div>
</article>
