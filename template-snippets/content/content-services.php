<?php

$child_pages = new WP_Query(
        array(
    'post_parent' => get_the_ID(),
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order'
        )
);

if ($child_pages->have_posts()):
    while ($child_pages->have_posts()):
        $child_pages->the_post();

        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="row">

                <div class="col-md-4">
                    <div class="text-right">
                        <?php

                        if ('' !== get_the_post_thumbnail() && !is_single()) :
                            get_template_part(SNIPPETS_DIR . '/post', 'thumbnail');
                        endif;

                        keitaro_child_pages_list(get_the_ID());

                        ?>
                    </div>
                    <?php dynamic_sidebar('keitaro_page_icon_blocks');

                    ?>
                </div>
                <div class="col-md-8">
                    <?php

                    if (is_sticky() && is_home()) :
//		echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
                    endif;

                    ?>
                    <header class="entry-header">
                        <?php

                        if ('post' === get_post_type()) {
                            echo '<div class="entry-meta">';
                            if (is_single()) {
//					twentyseventeen_posted_on();
                            } else {
//					echo twentyseventeen_time_link();
//					twentyseventeen_edit_link();
                            };
                            echo '</div><!-- .entry-meta -->';
                        };

                        if (is_single()) {
                            the_title('<h1 class="entry-title">', '</h1>');
                        } elseif (is_front_page() && is_home()) {
                            the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
                        } else {
                            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                        }

                        ?>
                    </header><!-- .entry-header -->

        <?php get_template_part(SNIPPETS_DIR . '/entry', 'content'); ?>

                </div>
            </div>
        </article><!-- #post-## -->
        <?php

    endwhile;

    unset($child_pages);

else:
    get_template_part(SNIPPETS_DIR . '/content/content-services', 'none');
endif;