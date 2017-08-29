<?php

$sidebar_id = 'keitaro_icon_blocks';

if ( is_active_sidebar( $sidebar_id ) ) :

    dynamic_sidebar( $sidebar_id );

endif;
