<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">
        <div class="col-md-8">
            <?php
            get_template_part(SNIPPETS_DIR . '/header/entry', 'header');

            if (is_archive()):
                get_template_part(SNIPPETS_DIR . '/entry', 'excerpt');
            else:
                get_template_part(SNIPPETS_DIR . '/entry', 'content');
            endif;
            ?>
        </div>
        <div class="col-md-4">
            <?php
            if (is_archive()):
            else:
                if ('' !== get_the_post_thumbnail() && !is_single()) :
                    get_template_part(SNIPPETS_DIR . '/post', 'thumbnail');
                endif;
                keitaro_child_pages_list($post->ID);

                get_template_part(SNIPPETS_DIR . '/entry', 'footer');
            endif;
            ?>
        </div>
    </div>

</article>