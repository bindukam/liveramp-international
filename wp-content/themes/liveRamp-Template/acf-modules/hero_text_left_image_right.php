<!-- new092920 -->
<section class="hero_text_left_image_right medium-blue-bkg">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell large-8 split-text margin-2">
				<img src="<?php the_sub_field('module_icon') ?>">
				<h1><?php the_sub_field('title') ?></h1>
				<?php $list_items = get_sub_field('list_items') ?>
				<ul>
					<?php foreach ($list_items as $list_item): ?>
						<li>
							<img src="<?php echo $list_item['icon'] ?>">
							<p><?php echo $list_item['item'] ?></p>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
			<div class="cell large-4 split-image">
				<div class="img-area">
					<img src="<?php the_sub_field('hero_image') ?>">
				</div>
			</div>
		</div>
	</div>
</section>	