<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

	if (get_the_post_thumbnail_url()) {
		$overlay = 'overlay';
		$big_header = '';

	}
	else {
		$overlay = '';
		$big_header = 'big-header';
		$add_waves = 'add-waves';

	}

	$post = get_post();

	// var_dump(get_post());
	$post_id = get_the_ID();

	$terms = get_the_terms( get_the_ID(), 'blog_categories' );

	// var_dump($terms);

	$term = $terms[0]->name;
	$term_id = $terms[0]->term_id;





get_header(); ?>
<?php setPostViews(get_the_ID()); ?>
<section class="blog-header medium-blue-bkg <?php echo $add_waves; ?>" id='blog-header'>
	<div class="grid-container">
		<div class="grid-x align-center header-grid  <?php echo $big_header ?>">
			<div class="cell breadcrumbs-wrapper">
				<div class="breadcrumbs-cell white">
					<p id="breadcrumbs">
					<a href="/careers/engineers/"><?php _translate('back_to_engineering')  ?></a>
					</p>
					
					<?php
						//if ( function_exists('yoast_breadcrumb') ) {
						 // yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
						//}
					?>
				</div>

			</div>
				<div class="cell medium-8 title-wrapper">
					<div class="terms core-blue">
						<p><?php echo $term; ?></p>
					</div>
					<div class="title white">
						<?php the_title( '<h1 class="flexo-regular">', '</h1>', true ); ?>
					</div>
					<div class="meta-wrapper white">
						<p><?php the_date() ?>&nbsp;&nbsp;|&nbsp;&nbsp; <?php the_author(); ?>&nbsp;&nbsp;<?php if ($term): ?>
							|&nbsp;&nbsp;<?php echo $term ?>
						<?php endif ?></p>
					</div>
				</div>
		</div>
	</div>
</section>
<section class="blog-post">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">

			<!-- sticky social links here -->
			<div class="cell medium-2 social-icons show-for-medium">
				<div data-sticky-container>
					<div class="sticky social-sticky" data-sticky data-top-anchor="blog-header:bottom" data-btm-anchor="post-footer:top" data-margin-top='10' data-margin-bottom='15'>
						<div class="share-icons">
							  <?php echo do_shortcode('[wp_social_sharing]') ?>
						</div>

					</div>
				</div>
			</div>
			<!-- end social sticky links -->

			<!-- <div class="medium-8 article <?php echo $overlay ?>" id="article">			 -->
			<div class="medium-8 article margin-top-2" id="article">			


				<div class="article-content">
					<?php the_content(); ?>
				</div>
				<!-- Comment functionality hidden for now: bug #622 -->				
				<div class="post-footer" id='post-footer'>
					<div class="grid-x">
						<?php //if (comments_open() || get_comments_number()): ?>
							<!--<div class="cell medium-6 leave-comment-wrapper">
								<div class="leave-comment" id="leave-comment">
									Leave a comment >
								</div>
							</div>-->
						<?php //endif ?>
						</div>
					</div>

					<?php //if (comments_open() || get_comments_number()): ?>
						<!--<div class="comments-wrapper" id="comments-wrapper">
							<div class="comments">
								<?php //comments_template(); ?>
							</div>
						</div>-->
					<?php //endif ?>

				</div>

			</div>
			<div class="cell right-column medium-2">

			</div>

		</div>
	</div>
</section>


			<?php

				// WP_Query arguments
				$args = array(
					'post_type'              => array( 'blog-post' ),
					'posts_per_page'         => '3',
					'tax_query'              => array(
						array(
							'taxonomy'         => 'blog_categories',
							'terms'            => $term_id,
						),
					),
				);

				// The Query
				$query = new WP_Query( $args );

				// The Loop
				if ( $query->have_posts() ) { ?>
					<section class="blog-footer">
						<div class="grid-container related-posts">
							<div class="grid-x grid-margin-x grid-margin-y">
								<div class="cell text-center">
									<h3><?php _translate('related_posts')  ?></h3>
									<img src="<?php echo get_template_directory_uri() ?>/dist/assets/images/svg/small-blue-line.svg" alt="small blue line" class="pad-1">
								</div>
							</div>
							<div class="grid-x grid-margin-x medium-up-3 grid-padding-y " data-equalizer='related-content'>


					<?php
					while ( $query->have_posts() ) {
						$query->the_post(); ?>
						<div class="cell related-post-wrapper click-card">
							<div class="grid-x">
								<div class="cell shrink related-image b-radius" style="background-image:url(<?php the_post_thumbnail_url( '' ); ?>)">

								</div>
								<div class="cell auto">
									<div class="content" >
										<div class="term">
											<?php echo $term ?>
										</div>
										<div class="title">
											<?php  the_title() ?>
										</div>
										<div class="author">
											<?php the_author(); ?>
										</div>
									</div>
								</div>
							</div>


						</div>

				<?php } ?>
						</div>
					</div>
				</section>

				<?php
				} else {
					// no posts found
				}

				// Restore original Post Data
				wp_reset_postdata();

			 ?>


<script>
$( document ).ready(function() {
	$('#leave-comment').on('click', function() {
		event.preventDefault();
		$('section#respond').show();
	});

	$('.sfsiplus_norm_row').css({
		position: 'unset'
	});
});
</script>

<?php $subscribe_form_id=get_field('engineering_subscribe_form_id', 'option');?>
<?php include( locate_template( 'template-parts/blog_archive_parts/blog_subscribe.php', false, false ) ); ?>
<?php get_footer();
