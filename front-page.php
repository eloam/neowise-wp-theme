<?php get_header(); ?>

<div class="self-center">

	<?php NwComponents::call('newsletter/nwsltr-section-header'); ?>
	
	<?php
		NwComponents::call('posts/posts-card'); 
	?>

	<?php NwComponents::call('posts/pagination'); ?>

	<?php //NwComponents::call('categories-list'); ?>
</div>

<?php get_footer(); ?>