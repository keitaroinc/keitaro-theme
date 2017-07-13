<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row">
		<div class="col-md-8">
			<?php

			get_template_part(SNIPPETS_DIR . '/header/entry', 'header');

			if (is_archive() || is_home() || is_search()) :
				get_template_part(SNIPPETS_DIR . '/entry', 'excerpt');
			else :
				if ('' !== get_the_post_thumbnail()) :
					get_template_part(SNIPPETS_DIR . '/post', 'thumbnail');
				endif;
				get_template_part(SNIPPETS_DIR . '/entry', 'content');
			endif;

			comments_template();

			?>
		</div>
		<div class="col-md-4">
			<?php

			if (!is_search()):
				keitaro_child_pages_list(get_the_ID());

				foreach (get_children(get_ancestors(get_the_ID())) as $page) :
					dynamic_sidebar('keitaro_page_icon_blocks');
				endforeach;
			endif;

			get_template_part(SNIPPETS_DIR . '/entry', 'footer');

			?>
		</div>
	</div>

</article>
