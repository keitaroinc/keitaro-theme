<div class="container">
  <div class="content main-footer">

    <?php $site_icon_url = get_site_icon_url(128); ?>
    <?php if ($site_icon_url) : ?>
      <div class="text-center">
        <a href="<?php home_url(); ?>"><img class="keitaro-symbol" src="<?php echo $site_icon_url ?>" alt="Keitaro"></a>
      </div>
    <?php endif; ?>
    <div class="row">

      <div class="col-md-6">
        <?php get_template_part('templates/navigation/footer', 'menu'); ?>
      </div>
      <div class="col-md-6">
        <div class="text-right">
          <?php get_template_part('templates/navigation/social', 'menu'); ?>
        </div>
      </div>

    </div>
    <hr>
    <div class="row">

      <div class="col-md-6">
        <?php get_template_part('templates/navigation/footer-secondary', 'menu'); ?>
      </div>
      <div class="col-md-6">
        <div class="text-right">
          <footer class="licenses">
            <p>&copy; <?php echo date('Y'); ?> <a href="<?php home_url(); ?>" class="text-uppercase"><?php bloginfo('name'); ?></a>. <?php _e('Some rights reserved.', 'keitaro') ?></p>
          </footer>
        </div>
      </div>

    </div>
  </div>
  <?php wp_footer(); ?>
</body>
</html>