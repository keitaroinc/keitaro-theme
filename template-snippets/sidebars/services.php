<?php

$sidebar_id = 'keitaro_services';

if ( is_active_sidebar( $sidebar_id ) ) :

    ?>
    <div class="services">
        <?php dynamic_sidebar( $sidebar_id ); ?>
    </div>
    <?php

endif;