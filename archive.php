<?php get_header(); ?>

<div class="self-center">
  <?php NwComponents::call('posts/posts-card'); ?>
  <?php NwComponents::call('posts/pagination'); ?>
</div>

<?php get_footer(); ?>