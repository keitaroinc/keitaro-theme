<?php

$page_title = '';

if ( is_author() ) :
	$page_title = __( 'Content by:', 'keitaro' );

elseif ( is_archive() ) :
	$page_title = single_cat_title( __( 'Archive:', 'keitaro' ) . ' ', false );
endif;

if ( ! empty( $page_title ) ) :

	?>
	<header class="page-header">
		<div class="row">
			<div class="col-md-8">
				<h1 class="page-title"><?php echo $page_title; ?></h1>
				<?php

				keitaro_posted_on();

				if ( is_author() ) :
					keitaro_author_box();
				endif;

				?>
			</div>
		</div>
	</header>
	<?php

endif;
