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
                        else :
                            get_template_part(SNIPPETS_DIR . '/content/content');
                        endif;

                    endwhile;

                    ?>
                </main>

                <?php

            else :

                get_template_part(SNIPPETS_DIR . '/content/content-none');

            endif;

            ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php get_template_part(SNIPPETS_DIR . '/navigation/pagination'); ?>
                </div>
            </div>
            <?php get_template_part(SNIPPETS_DIR . '/sidebars/twitter-content'); ?>
                
        </div>
    </div>

    <?php

endif;

get_sidebar();

get_footer();
