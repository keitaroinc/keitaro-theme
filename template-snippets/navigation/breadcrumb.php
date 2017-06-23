<?php
// Settings
$breadcrums_id = 'breadcrumb';
$breadcrums_class = 'breadcrumb';
$home_title = __('Home', 'keitaro');

// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
//$custom_taxonomy = 'product_cat';
// Get the query & post information
global $post, $wp_query;

function breadcrumb_item($url, $title = '', $wrapper = 'a') {
    ?>
    <li>
        <<?php echo $wrapper; ?> <?php
        if ($url) {
            echo 'href="' . $url . '"';
        }
        ?>>
        <?php echo $title; ?>
        </<?php echo $wrapper ?>>
    </li>
    <?php
}

// Do not display on the homepage
if (!is_front_page()) {
    $post_type_object
    ?>
    <div class="container-fluid">

        <?php
        // Build the breadcrums
        echo '<ol id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        breadcrumb_item(get_home_url(), __('Home', 'keitaro'));

        if (is_archive() && !is_tax() && !is_category() && !is_tag()) {
            breadcrumb_item(false, post_type_archive_title(false), 'span');
        } else if (is_archive() && is_tax() && !is_category() && !is_tag()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                breadcrumb_item(get_post_type_archive_link($post_type), get_post_type_object($post_type)->labels->name);
            }

            breadcrumb_item(false, get_queried_object()->name, 'span');
        } else if (is_single()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {
                breadcrumb_item(get_post_type_archive_link($post_type), get_post_type_object($post_type)->labels->name);
            }

            // Get post category info
            $category = get_the_category();

            if (!empty($category)) {

                // Get last category post is in
                $last_category = end(array_values($category));

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                $cat_parents = explode(',', $get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach ($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">' . $parents . '</li>';
                }
            }
            breadcrumb_item(get_post_type_archive_link($post_type), get_post_type_object($post_type)->labels->name);
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                $cat_id = $taxonomy_terms[0]->term_id;
                $cat_nicename = $taxonomy_terms[0]->slug;
                $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name = $taxonomy_terms[0]->name;
            }

            // Check if the post is in a category
            if (!empty($last_category)) {
                echo $cat_display;

                breadcrumb_item(false, get_the_title(), 'span');

                // Else if post is in a custom taxonomy
            } else if (!empty($cat_id)) {

                breadcrumb_item($cat_link, $cat_name);
                breadcrumb_item(false, get_the_title(), 'span');
            } else {
                breadcrumb_item(false, get_the_title(), 'span');
            }
        } else if (is_category()) {

            // Category page
            breadcrumb_item(false, single_cat_title('', false), 'span');
        } else if (is_page()) {

            // Standard page
            if ($post->post_parent) {

                // If child page, get parents 
                $anc = get_post_ancestors($post->ID);

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                if (!isset($parents)) {
                    $parents = null;
                }
                foreach ($anc as $ancestor) {
                    breadcrumb_item(get_permalink($ancestor), get_the_title($ancestor));
                }

                // Current page
                breadcrumb_item(false, get_the_title(), 'span');
            } else {

                // Just display current page if not parents
                breadcrumb_item(false, get_the_title(), 'span');
            }
        } else if (is_tag()) {

            // Tag page
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args = 'include=' . $term_id;
            $terms = get_terms($taxonomy, $args);
            $get_term_id = $terms[0]->term_id;
            $get_term_slug = $terms[0]->slug;
            $get_term_name = $terms[0]->name;

            // Display the tag name
            breadcrumb_item(false, $get_term_name, 'span');
        } elseif (is_day()) {

            // Day archive
            // Year link
            breadcrumb_item(get_year_link(get_the_time('Y')), get_the_time('Y'));
            // Month link
            breadcrumb_item(get_year_link(get_the_time('M')), get_the_time('M'));
            // Day display
            breadcrumb_item(false, get_the_time('j'), 'span');
        } else if (is_month()) {

            // Month Archive
            // Year link
            breadcrumb_item(get_year_link(get_the_time('Y')), get_the_time('Y'));
            // Month display
            breadcrumb_item(false, get_the_time('m'), 'span');
        } else if (is_year()) {

            // Display year archive
            breadcrumb_item(false, get_the_time('Y'), 'span');
        } else if (is_author()) {

            // Auhor archive
            // Get the author information
            global $author;
            $userdata = get_userdata($author);

            // Display author name
            breadcrumb_item(false, __('Author: ') . $userdata->display_name, 'span');
        } else if (get_query_var('paged')) {

            // Paginated archives
            breadcrumb_item(false, __('Page ', 'keitaro') . get_query_var('paged'), 'span');
        } else if (is_search()) {

            // Search results page
            breadcrumb_item(false, __('Search results for: ', 'keitaro') . get_search_query(), 'span');
        } elseif (is_404()) {

            // 404 page
            echo '<li>' . __('Error 404', 'keitaro') . '</li>';
        }

        echo '</ol>';
    }
    ?>
</div>