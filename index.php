<?php get_header(); ?>

<div class="container">

    <div id="primary" class="content-area">
        <?php

        if (!is_front_page()) :

            if (have_posts()) :

                get_template_part(SNIPPETS_DIR . '/header/page-header');

                ?>
                <main id="main" class="site-main" role="main">

                    <?php

                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        if (is_page()) :
                            get_template_part(SNIPPETS_DIR . '/content/content-page');
                        else :
                            get_template_part(SNIPPETS_DIR . '/content/content');
                        endif;

                    endwhile;

                    get_template_part(SNIPPETS_DIR . '/navigation/pagination');

                    ?>
                </main>

                <?php

            else :
                get_template_part(SNIPPETS_DIR . '/content/content-none');
            endif;


            get_template_part(SNIPPETS_DIR . '/sidebars/twitter-content');

            ?>

        <?php endif; ?>
    </div>
</div>

<?php

get_sidebar();

get_footer();
