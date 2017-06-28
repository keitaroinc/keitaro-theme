<?php get_header(); ?>

<div class="container">
    <?php // get_template_part(SNIPPETS_DIR . '/header/page', 'header'); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            if (have_posts()) :
                /* Start the Loop */
                while (have_posts()) :
                    the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part(SNIPPETS_DIR . '/content/content', 'page');
                endwhile;

            else :
                get_template_part(SNIPPETS_DIR . '/content/content', 'none');
            endif;
            ?>
        </main>

    </div>
    <?php get_sidebar(); ?>
</div>

<?php
get_footer();