<?php if ( get_the_content() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php

		get_template_part( SNIPPETS_DIR . '/header/entry-header' );
		get_template_part( SNIPPETS_DIR . '/entry-content' );

		?>
	</article>
	<?php
endif;
