<?php get_header(); ?>

<div class="my-24">
  <?php NwComponents::call('posts/article'); ?>
  <?php NwComponents::call('posts/comments'); ?>
  <?php NwComponents::call('posts/leave-comment'); ?>
</div>

<?php get_footer(); ?>