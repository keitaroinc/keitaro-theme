<?php
/**
 * Template Name: Contact Page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

get_header();

?>
			<?php
			// if ( have_posts() ) :
			// 	/* Start the Loop */
			// 	while ( have_posts() ) :
			// 		the_post();

			// 		get_template_part( SNIPPETS_DIR . '/content/content-contact-page' );

			// 	endwhile;
			// else :
			// 	get_template_part( SNIPPETS_DIR . '/content/content-none' );
			// endif;
		?>
<div class="showcases-header d-flex flex-column">
	<div class="showcases-content">
	<?php the_content();?>
	</div>
	<?php
	the_post_thumbnail();
	?>
</div>

			
<div class="container my-5 py-5 bg-white">
  <div class="row checkboxes-row" id="checkboxes">

    <div class="col-12 checkbox-wrapper">
      <div class="row">

          <div class="col-md-4 my-2">
            <label class="custom-checkbox"><p>Get a quote</p>
              <input id="checkbox-1" value="div-1" type="checkbox" checked="true" onclick="showElement()">
              <span class="checkmark"></span>
            </label>
          </div>

          <div class="col-md-4 my-2">
            <label class="custom-checkbox"><p>Request for information</p>
              <input id="checkbox-2" value="div-2" onclick="showElement()" type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>

          <div class="col-md-4 my-2">
            <label class="custom-checkbox"><p>Information about our products</p>
              <input id="checkbox-3" value="div-3" onclick="showElement()" type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>

          <div class="col-md-4 my-2">
            <label class="custom-checkbox"><p>Partner with Keitaro</p>
              <input id="checkbox-4" value="div-4" onclick="showElement()" type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>

          <div class="col-md-4 my-2">
            <label class="custom-checkbox"><p>Career at Keitaro</p>
              <input id="checkbox-5" value="div-5" onclick="showElement()" type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>

          <div class="col-md-4 my-2">
            <label class="custom-checkbox"><p>Other</p>
              <input id="checkbox-6" value="div-6" onclick="showElement()" type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>

        </div>
      </div>

  </div>
  <hr>
  <div class="row px-5 d-flex my-5 flex-column">

    <div id="div-1" style="display:inline-block; opacity:1; transform: scale(1);transition: .4s ease opacity,.4s ease transform;margin:10px 0;">
      <form class="row">
        <div class="form-group col-5">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group col-5">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="col-3">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>

    <!-- <p id="div-1"  style="display:block; opacity:1; transform: scale(1);transition: .6s ease opacity,.6s ease transform;">DIV ONE</p> -->
    <p id="div-2"  style="display:none;opacity:0; transform: scale(0);transition: .6s ease opacity,.6s ease transform;">DIV TWO</p>
    <p id="div-3"  style="display:none;opacity:0; transform: scale(0);transition: .6s ease opacity,.6s ease transform;">DIV THREE</p>
    <p id="div-4"  style="display:none;opacity:0; transform: scale(0);transition: .6s ease opacity,.6s ease transform;">DIV FOUR</p>
    <p id="div-5"  style="display:none;opacity:0; transform: scale(0);transition: .6s ease opacity,.6s ease transform;">DIV FIVE</p>
    <p id="div-6"  style="display:none;opacity:0; transform: scale(0);transition: .6s ease opacity,.6s ease transform;">DIV SIX</p>
</div>

<?php

get_sidebar();

get_footer();
