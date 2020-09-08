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
if(is_front_page()):
	?> 
	<!-- <h1>New blocks here</h1> -->
	<?php

	if ( have_posts() ) :
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			?>
			<div class="container-fluid home-content-wrapper my-5 ">
			<?php
			the_content();
			
			?>
			</div>
			<?php
		endwhile;
	else :
		get_template_part( SNIPPETS_DIR . '/content/content-none' );
	endif;
else:
endif;
// endhomepage
if ( ! is_front_page() ) :
	?>
	<?php
	if ( have_posts() ) :
		?>
		<div class="container-fluid bg-white">

			<div id="primary" class="content-area">
				<?php get_template_part( SNIPPETS_DIR . '/header/page-header' ); ?>
				<main id="main" class="site-main" role="main">
					<div class="container blogs-content px-xl-0">
						<div class="row">
							<?php if(is_home()):
							?>
							<h1 class="entry-title insights-title mb-5">Insights</h1>
							<?php
							endif;
								?>
					<?php
					/* Start the Loop */
					$counter = 0;
					while ( have_posts() ) :
						the_post();
						if ( is_page() ) :
							get_template_part( SNIPPETS_DIR . '/content/content-page' );		
						else :
							if (is_single()):
								?>
												<div class="d-flex justify-content-center single-post-wrapper">
													<div class="col-md-12 my-3">
														<div class='px-5'>
															<?php keitaro_author_avatar( get_the_author_meta( 'ID' ) );?>
																<p>By <?php the_author(); ?></p>
																<div class="blogs-content-categories"><?php 
														the_category(); ?></div>
															<h2 class="mb-5"><?php the_title(); ?></h2>
													</div>
													<?php the_post_thumbnail(); ?>
														<div class='my-5 px-5'>
														<p><?php the_content(); ?></p>
														</div>
													</div>
													<hr>
												</div>

							<?php
								get_template_part( SNIPPETS_DIR . '/content/content-read-next' );
							else:
								
								$counter = $counter + 1;
								if($counter == 1):
									?>
										<div class="col-12 my-5 ">

											<div class="row d-flex align-items-start">

												<div class="col-md-12 col-lg-8 order-2" style="display:inline-block">
													<?php 
														the_post_thumbnail(); 
													?> 
												<div class="blogs-content-categories"><?php 
														the_category(); ?></div>

												<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
												
												<p><?php the_excerpt(__('(more…)')); ?></p>
												<?php keitaro_author_avatar( get_the_author_meta( 'ID' ) );?>
												<p>By <?php the_author(); ?></p>
												</div>
												<div class="col-md-12 col-lg-4 order-1 order-lg-12 mb-5" >
													<ul class="blog-list-categories">	
													<?php 
													 get_search_form(); 
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
													<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
													<div class="blogs-content-categories"><?php 
														the_category(); ?></div>
													<div>
													<?php keitaro_author_avatar( get_the_author_meta( 'ID' ) );?>
													<p>By <?php the_author(); ?></p>
													</div>
												</div>
										<?php
									//get_template_part( SNIPPETS_DIR . '/content/content' );
								endif;
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
