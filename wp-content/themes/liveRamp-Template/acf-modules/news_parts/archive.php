<?php 
	// var_dump($post); 

	$temp_post = $post;
?>


<div class="grid-x large-up-3 grid-margin-x grid-margin-y" id="news-card-wrapper">
	<?php 
		
		// WP_Query arguments
		$args = array(
			'post_type'              => array( 'news' ),
			'posts_per_page'         => '12',
		);

		// The Query
		$wp_query = new WP_Query( $args );

		// The Loop
		if ( $wp_query->have_posts() ) {
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post(); ?>
				
				<?php include('news_card.php') ?>

		<?php	
			}

		} else {
			// no posts found
		}

		// // Restore original Post Data
		// wp_reset_postdata();


	 ?>	
</div>
<div id="more-button">
	<?php if (  $wp_query->max_num_pages > 1 ) : // don't display the button if there are not enough posts ?>
		<div class="text-center pad-1">
				<div class="button news_loadmore outline down-arrow"><?php _translate('more_posts') ?></div>
			</div>
	<?php endif; ?>	
</div>
	
<script>
	var posts_myajax = '<?php echo serialize( $wp_query->query_vars ) ?>',
    current_page_myajax = 2,
    max_page_myajax = <?php echo $wp_query->max_num_pages ?>
</script>

<?php 
// Restore original Post Data
		wp_reset_postdata();
		?>		


<?php 
	$post = $temp_post;	
	// var_dump($post); 
?>