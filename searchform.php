<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only" for="<?php echo $unique_id; ?>"><?php echo _x( 'Search for:', 'label', 'keitaro' ); ?></label>

	<div class="input-group">
		<input type="search" id="<?php echo $unique_id; ?>" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'keitaro' ); ?>" required="required" value="<?php echo get_search_query(); ?>" name="s" />
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
		</span>
	</div>

</form>
