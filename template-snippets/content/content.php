<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">
        <div class="col-md-8">
            <?php

            get_template_part(SNIPPETS_DIR . '/header/entry', 'header');

            if (is_archive()):
                get_template_part(SNIPPETS_DIR . '/entry', 'excerpt');
            else:
                if ('' !== get_the_post_thumbnail()) :
                    get_template_part(SNIPPETS_DIR . '/post', 'thumbnail');
                endif;
                get_template_part(SNIPPETS_DIR . '/entry', 'content');
            endif;

            ?>
        </div>
        <div class="col-md-4">
            <?php

            if (is_archive()):
            // show something
            else:
                keitaro_child_pages_list($post->ID);

            endif;
            get_template_part(SNIPPETS_DIR . '/entry', 'footer');

            ?>
        </div>
    </div>

</article>