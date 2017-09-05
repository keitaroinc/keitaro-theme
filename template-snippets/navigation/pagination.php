<?php

echo wp_kses_post( paginate_links( array(
	'mid_size' => 6,
	'type' => 'list',
) ) );
