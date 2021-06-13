<?php get_header(); ?>

<div class="container-wrapper">
  <?php NwComponents::call('posts/article'); ?>
  <?php NwComponents::call('posts/comments'); ?>
  <?php NwComponents::call('posts/leave-comment'); ?>
</div>

<?php get_footer(); ?>