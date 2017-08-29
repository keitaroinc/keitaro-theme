<?php

$sidebar_id = 'keitaro_service_icons';

if ( is_active_sidebar( $sidebar_id ) ) :

    ?>
    <ul class="list-inline list-service-icons list-wide">
        <?php

        dynamic_sidebar( $sidebar_id );

        ?>
    </ul>
    <?php

endif;