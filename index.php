<?php

get_header();

if (!is_front_page()) :

    if (have_posts()) :

        ?>
        <div class="container">
            <div id="primary" class="content-area">

                <?php get_template_part(SNIPPETS_DIR . '/header/page-header'); ?>
                <main id="main" class="site-main" role="main">

                    <?php

                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();

                        if (is_page()) :
                            get_template_part(SNIPPETS_DIR . '/content/content-page');
                        elseif (is_home() && $paged < 1):
                            get_template_part(SNIPPETS_DIR . '/content/content-featured');
                        else :
                            get_template_part(SNIPPETS_DIR . '/content/content');
                        endif;

                    endwhile;

                    if (is_home() && $paged < 1):
                        keitaro_continue_to_second_blog_posts_page_button(__('Continue', 'keitaro'), get_post_type_archive_link('post'));
                    else:
                        get_template_part(SNIPPETS_DIR . '/navigation/pagination');
                    endif;

                    ?>
                </main>

                <?php

            else :

                get_template_part(SNIPPETS_DIR . '/content/content-none');

            endif;

            get_template_part(SNIPPETS_DIR . '/sidebars/twitter-content');

            ?>
        </div>
    </div>

    <?php

endif;

get_sidebar();

get_footer();
