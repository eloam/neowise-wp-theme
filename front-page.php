<?php get_header(); ?>

<div class="container-wrapper">

	<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if ($paged == 1) {
			NwComponents::call('posts/last-posts');
		}
	?>

	<div class="container">
		<?php NwComponents::call('nwsltr-section-header'); ?>
		
		<?php
			$customQuery = array();
			
			// Sur la première page, on affiche pas les 3 premiers posts
			$currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1;    
			if ($currentPage == 1) {
				$postsFirstPage = get_option('posts_per_page') - 3;
				$customQuery = array('offset' => 3, 'posts_per_page' => $postsFirstPage);
			}
				
			NwComponents::call('posts/posts-card', $customQuery); 
		?>

		<?php NwComponents::call('posts/pagination'); ?>
	</div>

	<?php NwComponents::call('categories-list'); ?>
</div>

<?php get_footer(); ?>