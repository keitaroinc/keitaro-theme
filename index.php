<?php
/**
 * Template for all pages, when not overridden
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

get_header();

if ( ! is_front_page() ) :

	if ( have_posts() ) :

		?>
		<div class="container-fluid bg-white">
			<div id="primary" class="content-area">
				<?php get_template_part( SNIPPETS_DIR . '/header/page-header' ); ?>
				<main id="main" class="site-main" role="main">
					<div class="px-0">
						<div class="row">
					<?php

					/* Start the Loop */
					$counter = 0;
					while ( have_posts() ) :
						the_post();
						if ( is_page() ) :
							get_template_part( SNIPPETS_DIR . '/content/content-page' );		
						else :
							$counter = $counter + 1;
							if($counter == 1):
								?>
									<div class="col-12 my-5">

										<div class="row d-flex align-items-start">

											<div class="col-md-12 col-lg-9 order-2" style="display:inline-block">
												<?php the_post_thumbnail(); ?> 
											

											<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
											<p><?php the_excerpt(__('(more…)')); ?></p>
											<?php keitaro_author_avatar( get_the_author_meta( 'ID' ) );?>
											<p>By <?php the_author(); ?></p>
											</div>
											<div class="col-md-12 col-lg-3 order-1 order-lg-12 mb-5" >
												<ul class="blog-list-categories">	
												<?php 
													wp_list_categories('orderby=name&title_li=&show_count=1'); 
												?>
												</ul>
											</div>
										</div>
									</div>
								<?php
							else:
									?>
											<div class="col-md-4 col-12 my-5">
											<?php the_post_thumbnail(); ?>
												<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
												<div>
												<?php keitaro_author_avatar( get_the_author_meta( 'ID' ) );?>
												<p>By <?php the_author(); ?></p>
												</div>
											</div>
									<?php
								//get_template_part( SNIPPETS_DIR . '/content/content' );
							endif;
							//get_template_part( SNIPPETS_DIR . '/content/content' );
						endif;

					endwhile;

					?>
					</div>
					</div>
				</main>
					
				<?php

			else :

				get_template_part( SNIPPETS_DIR . '/content/content-none' );

			endif;

			if ( $paged && ( ! is_author() && ! is_404() ) ) :

				?>

				<div class="row">
					<div class="col-md-8 offset-md-2">
						<?php get_template_part( SNIPPETS_DIR . '/navigation/pagination' ); ?>
					</div>
				</div>

				<?php

			else :
				?>
				<div class="row">
					<div class="col-md-8 offset-md-2">
				<?php
				get_template_part( SNIPPETS_DIR . '/navigation/pagination' );
				?>
					</div>
				</div>
				<?php
			endif;

			get_template_part( SNIPPETS_DIR . '/sidebars/twitter-content' );

			?>

		</div>

	</div>

	<?php

endif;

get_sidebar();

get_footer();
