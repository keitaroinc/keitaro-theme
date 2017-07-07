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

            keitaro_child_pages_list(get_the_ID());

            var_dump(get_children(get_ancestors(get_the_ID())));

            foreach (get_children(get_ancestors(get_the_ID())) as $page):
                dynamic_sidebar('keitaro_page_icon_blocks');
            endforeach;

            get_template_part(SNIPPETS_DIR . '/entry', 'footer');

            ?>
        </div>
    </div>

</article>