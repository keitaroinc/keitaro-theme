<?php
/*
 * Template Name: Full-width
 */
get_header();
?>

<div class="container">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            if (have_posts()) :
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    get_template_part(SNIPPETS_DIR . '/content/content');
                endwhile;
            endif;
            ?>
        </main>

    </div>
    <?php get_sidebar(); ?>
</div>

<?php
get_footer();
