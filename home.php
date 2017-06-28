<?php get_header(); ?>

<div class="container">
    <?php
    get_template_part(SNIPPETS_DIR . '/header/page', 'header');
    get_sidebar();
    ?>
</div>

<?php
get_footer();