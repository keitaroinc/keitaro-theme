<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>

    <div class="container-bg">
      <div class="<?php
      if (is_home()) : echo 'container';
      else : echo 'container-fluid';
      endif;
      ?>">
        <header class="main-navbar content-block">
          <div class="row">
            <div class="col-sm-3 col-md-4 col-lg-3">
              <?php get_template_part('templates/header/logo'); ?>
            </div>
            <div class="col-sm-9 col-md-8 col-lg-9">
              <?php get_template_part('templates/navigation/main', 'menu'); ?>
            </div>
          </div>
        </header>
      </div>
    </div>
    <?php
    if (is_home()):
      get_template_part('templates/header/hero');
    endif;