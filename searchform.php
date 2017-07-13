<?php $unique_id = esc_attr(uniqid('search-form-')); ?>

<div class="row">
	<div class="col-md-4 <?php echo ((!is_front_page() && !is_404()) ? 'pull-right' : ''); ?>">

		<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
			<label class="sr-only" for="<?php echo $unique_id; ?>"><?php echo _x('Search for:', 'label', 'keitaro'); ?></label>

			<div class="input-group">
				<input type="search" id="<?php echo $unique_id; ?>" class="form-control search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'keitaro'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
				<div class="input-group-btn">
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
				</div>
			</div>

		</form>

	</div>
</div>