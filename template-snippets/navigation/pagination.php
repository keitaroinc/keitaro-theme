<?php

echo wp_kses( paginate_links( array(
	'mid_size' => 6,
	'type' => 'list',
		) ), array( 'ul' => array( 'class' => array() ), 'li' => array( 'a' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'class' => array(), 'href' => array() ) ) );
