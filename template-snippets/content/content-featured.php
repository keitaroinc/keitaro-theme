<?php

$is_first_post = false;

if ($wp_query->current_post < 1):
    $is_first_post = true;
endif;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('featured-post'); ?>>

    <div class="row">
        <div class="col-md-2 avatar-wrapper">
            <?php

            if ($is_first_post || is_sticky()):
                keitaro_author_avatar(get_the_author_meta('ID'), 128);
            else:
                keitaro_author_avatar(get_the_author_meta('ID'), 64);
            endif;

            ?>
        </div>
        <div class="col-md-8">
            <?php

            if ($is_first_post || is_sticky()) :
                get_template_part(SNIPPETS_DIR . '/header/entry-header');

                get_template_part(SNIPPETS_DIR . '/entry-excerpt');
            else:
                get_template_part(SNIPPETS_DIR . '/header/featured-entry-header');
            endif;

            ?>
        </div>        
    </div>

</article>