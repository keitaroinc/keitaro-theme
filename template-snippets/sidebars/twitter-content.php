<?php

global $paged;

if (is_home() && $paged < 1):
    dynamic_sidebar('keitaro_twitter'); 
endif;