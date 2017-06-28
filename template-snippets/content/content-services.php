<?php
global $post;
$child_pages = get_children(
        array(
            'post_parent' => get_the_ID(),
            'order' => 'ASC',
            'orderby' => 'menu_order'
        )
);
if ($child_pages):
    foreach ($child_pages as $page):

        $post = $page;
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="row">

                <div class="col-md-4 text-right">
                    <?php
                    if ('' !== get_the_post_thumbnail() && !is_single()) :
                        get_template_part(SNIPPETS_DIR . '/post', 'thumbnail');
                    endif;
                    keitaro_child_pages_list($post->ID);
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

                    <?php
                    get_template_part(SNIPPETS_DIR . '/entry', 'content');

                    if (is_single()) {
//		twentyseventeen_entry_footer();
                    }
                    ?>

                </div>
            </div>
        </article><!-- #post-## -->
        <?php
        wp_reset_query();
    endforeach;
else:
    get_template_part(SNIPPETS_DIR . '/content/content-services', 'none');
endif;