<?php get_header(); ?>

<div class="container-wrapper">
	<div class="container">
		<h1><?php echo single_term_title(); ?></h1>
		<?php NwComponents::call('posts/posts-card'); ?>
		<?php NwComponents::call('posts/pagination'); ?>
	</div>
</div>

<?php get_footer(); ?>