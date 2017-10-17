<?php
/**
 * Template Name: Image Left - Splash
 *
 * Description: Half side featured image, half side content. SPLASH = There's no menus, sidebars, header or footer.
 *
 * @package WordPress
 * @subpackage Prandible
 * @since Prandible 1.0
 */
get_header( 'splash' ); ?>

<style>
/* makin sure there's no footer, header, sidebar - just 100% content */
body.page-template-page-image-left-splash #left-panel,
body.page-template-page-image-left-splash #mobile-menu {
  display: none !important;
}
body.page-template-page-image-left-splash.is-desktop:not(.left-menu-open)[data-logo="1"] #left-panel-inner {
  padding-top: 0 !important;
}
body.page-template-page-image-left-splash:not(.left-menu-open) #right-panel-inner {
  margin-left: 0 !important;
}
body.page-template-page-image-left-splash.is-desktop:not(.left-menu-open)[data-logo="1"] #right-panel {
  margin-top: 0 !important;
}
body.page-template-page-image-left-splash #inner-wrap {
    margin-top: 0 !important;
}
body.is-desktop.left-menu-open[data-logo="1"] #right-panel {
    margin-top: 0 !important;
}
body.page-template-page-image-left-splash header#masthead,
body.page-template-page-image-left-splash footer#colophon {
  display: none !important;
}
body.page-template-page-image-left-splash #main-wrap {
  background-color: #ffffff;
  min-height: 100vh;
}
body.page-template-page-image-left-splash #primary {
  width: 100%;
}

/* now the 2 columns and featured image */
body.page-template-page-image-left-splash #image-wrap {
  background-size: cover;
  height: 50vh;
  position: fixed;
  left: 0;
  top: 0;
  bottom: 0;
  width: 100%;
}
body.page-template-page-image-left-splash.buddypress #primary .entry-content {
    padding: 40px;
    box-sizing: border-box;
}
body.page-template-page-image-left-splash #content {
  float: none;
  margin-top: 50vh;
}
@media (max-width: 767px) {
  .hidden-xs {
    display: none;
  }
}
@media (min-width: 768px) {
}
@media (min-width: 992px) {
  body.page-template-page-image-left-splash #image-wrap {
    height: 100vh;
    width: 50%;
  }
  .col-md-6 {
    width: 50%;
    display: inline-block;
    float: left;
  }
  body.page-template-page-image-left-splash #content {
    float: right;
    margin-top: 0;
  }
}



/* Some Register Form Styles */

.the_buddyforms_form .bf-input textarea, .the_buddyforms_form .bf-input .form-control {
    border: 2px solid #bac2c6;
    background: #fff;
    box-shadow: none !important;
}
.bf_field_group {
    margin: 0 0 15px 0;
}
.the_buddyforms_form .form-actions button.bf-submit {
  height: 40px;
  width: 220px;
  display: inline-block;
  padding: 10px 35px;
  text-align: center;
  border-radius: 40px;
}



</style>

<div class="page-image-left-splash">

  	<div id="primary" class="site-content">

        <div id="image-wrap" class="xhidden-xs col-md-6" style="background: #e1e2e3 url('<?php echo get_the_post_thumbnail_url( 1204, 'full' ); ?>') 0 0 scroll no-repeat; background-size: cover;">
        </div>

    		<div id="content" role="main" class="col-md-6">
    			<?php while ( have_posts() ) : the_post(); ?>
    				<?php get_template_part( 'content', 'page' ); ?>
    			<?php endwhile; ?>
    		</div>

  	</div>

</div><!-- .page-image-left-splash -->






<?php
/*
 * THE FOOTER
 * instead of pulling a footer.php,
 * we just finish right here, neat and clean.
 *
 * Let's start:
 */
 ?>

</div><!-- #main .wrapper -->

</div><!-- #page -->

</div> <!-- #inner-wrap -->

</div><!-- #main-wrap (Wrap For Mobile) -->

</div><!-- #right-panel-inner -->
</div><!-- #right-panel -->

</div><!-- #panels -->

<?php wp_footer(); ?>

</body>
</html>
