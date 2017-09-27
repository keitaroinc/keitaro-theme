<?php

$sidebar_id = 'keitaro_service_icons';

if ( is_active_sidebar( $sidebar_id ) ) :

	?>
	<div class="container">
		<ul class="list-service-icons">
			<?php

			dynamic_sidebar( $sidebar_id );

			?>
		</ul>
	</div>
	<?php

endif;
