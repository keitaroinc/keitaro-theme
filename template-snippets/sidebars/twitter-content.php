<?php if ( is_home() && $paged < 1 ) : ?>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?php dynamic_sidebar( 'keitaro_twitter' ); ?>
		</div>
	</div>
	<?php
endif;
