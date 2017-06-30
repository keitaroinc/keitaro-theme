<?php

// Number of author posts
the_author_posts();

// Link to author archive
the_author_posts_link();

// Post publish date
the_date();

// Display a list of post categories
if (get_the_category()) {
    printf('<h4>%s</h4>', __('Categories', 'keitaro'));
}
the_category();

// Display a list of post tags
the_tags(sprintf('<h4>%s</h4>', __('Tags', 'keitaro')) . '<ul class="post-tags"><li>', '</li><li>', '</li></ul>');