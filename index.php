<?php get_header(); ?>

<div class="container">
    <?php if (!is_front_page()) : ?>
        <header class="page-header">
            <h1 class="page-title"><?php single_post_title(); ?></h1>
        </header>
    <?php endif; ?>

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
                endwhile;

            else :
            endif;
            ?>
        </main>

    </div>
    <?php get_sidebar(); ?>
</div>

<?php
get_footer();
