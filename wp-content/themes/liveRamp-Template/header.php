<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

 // THEM URI to link to images within the assets folder
 $theme_uri = get_template_directory_uri();
 // Theme assets folder
 $theme_images = $theme_uri.'/dist/assets/images';
 $theme_svg = $theme_images.'/svg';

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<?php include ('library/hreflang.php') ?>

		<?php 
			$code_loop = get_field('code_loop', 'option'); 

			foreach ($code_loop AS $code) {
				echo "\n" . '<!-- '.strtoupper($code['title']).' -->';
				echo "\n" . $code['code_block'] . "\n";
			}
		?>

		<!-------------------- GLOBAL CODE -------------------->

		<!-- VIMEO TRACKING CODE -->
		<script type='text/javascript' defer='defer' src='<?php echo $theme_uri; ?>/dist/assets/js/10577812.js'></script>
		<!-- END VIMEO TRACKING CODE -->

		<!-- VIMEO PLAYER API -->
		<script type='text/javascript' src="<?php echo $theme_uri; ?>/dist/assets/js/vimeo-player.js"></script>
		<!-- END VIMEO PLAYER API -->

		<!-- wistia script  -->
		<script type='text/javascript' charset="ISO-8859-1" src="<?php echo $theme_uri; ?>/dist/assets/js/E-v1.js" async></script>



		<!-- iframe resizer  -->
		<style>	.ubermenu  svg.ubermenu-image {	max-width: 1em; } </style>

		<?php wp_head(); ?>
		
		<?php 
			$code_loop = get_field('code_loop_below_css', 'option'); 

			//echo '<pre style="background-color:white">'.print_r($code_loop, 1).'</pre>';
			foreach ($code_loop AS $code) {
				echo "\n" . '<!-- '.strtoupper($code['title']).' -->';
				echo "\n" . $code['code_block'] . "\n";
			}
		?>

	</head>
<body <?php body_class(); ?>>

	<!-- GTM Body Code -->
	<?php the_field('gtm_body_code', 'option') ?>
	<!-- End GTM Body Code -->	

	<div class="section reveal fullwidth white-bkg" id="searchModal" data-reveal data-animation-in="slide-in-down" data-animation-out="slide-out-up" data-v-offset="0">
	 <div class="grid-container">
	 	<div class="grid-x align-center align-middle">
	 	  <div class="cell large-8 pad-1">
	 	    <div class="search">
	 	      <?php get_search_form(); ?>
	 	    </div>
	 	  </div>
	 	</div>
	 </div>	
	  <button class="close-button" data-close aria-label="Close modal" type="button">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>

	<div data-sticky-container style="z-index:100;">

		<div data-sticky data-options="marginTop:0;" style="width:100%">
			<header id="header" class="white-bkg">
				<!-- <div class="grid-container"> -->
					<div class="grid-x grid-padding-x align-middle nav-head">
						<div class="cell small-10 large-2">
							<div class="logo">
								<a href="<?php echo site_url(); ?>">
									<?php echo file_get_contents("$theme_svg/lr_logo.svg"); ?>
								</a> 
								<span class="careers-logo">  &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;Careers</span>
							</div>
						</div>
						<div class="cell small-2 hide-for-xlarge text-right" id="shiftnav-toggle-wrapper">
							<!-- <?php foundationpress_top_menu(); ?> -->
							<a class="shiftnav-toggle shiftnav-toggle-button" data-shiftnav-target="shiftnav-main"><i class="fa fa-bars"></i></a>
						</div>
						<div class="cell large-10 medium-12 show-for-xlarge">
							<div class="grid-x menus align-right">
								<div class="cell small-12 top-menu">
									<?php foundationpress_top_menu(); ?>
								</div>
								<div class="cell small-12 mega-menu">
									<?php foundationpress_mega_menu(); ?>
								</div>
							</div>
						</div>

					</div>
				
			</header>
			</div>
		<!-- </div> -->

	</div>

   <?php
   $colors = get_the_terms( get_the_ID(),'color_theme');
   $blogcolor = get_the_terms( 1024874,'color_theme');
    ?>

   <?php
   if (
         ! empty( $blogcolor )
         && ! is_wp_error( $blogcolor )
         && get_post_type( get_the_ID() ) == 'blog-post'
      ){
        $thecolortheme = $blogcolor[0]->slug ;
   }

   if (
	 get_post_type( get_the_ID() ) == 'engineering'
	){
		$thecolortheme = 'medium-blue' ;
	}

   if ( ! empty( $colors ) && ! is_wp_error( $colors ) ){
        $thecolortheme = $colors[0]->slug ;
   }
   ?>

   <?php if ($thecolortheme=='custom-home-page'): ?>
	   <div id="green-theme" class="color-theme new-home-page-theme">
   <?php else: ?>
	   <div id="<?php echo $thecolortheme; ?>-theme" class="color-theme">
   <?php endif ?>

