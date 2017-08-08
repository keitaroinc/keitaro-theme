<?php

$hero_class = '';
$header_image = get_header_image();

if ($header_image == DEFAULT_HEADER_IMAGE):
    $header_image_style = 'style="background-image: url(' . $header_image . '), url(' . DEFAULT_HEADER_IMAGE_EXTEND . ')"';
else:
    $hero_class = 'hero-non-default';
    $header_image_style = 'style="background-image: url(' . $header_image . '); background-size: cover"';
endif;

?>
<div class="hero <?php echo $hero_class; ?>" <?php echo ($header_image ? $header_image_style : '') ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-7">
                <?php do_shortcode('[keitaro-hero-title]'); ?>
            </div>
        </div>
        <?php get_template_part(SNIPPETS_DIR . '/sidebars/services'); ?>
    </div>
</div>
