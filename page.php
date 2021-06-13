<?php get_header(); ?>

<div class="container-wrapper">
  <?php NwComponents::call('posts/article', array('comments' => false)); ?>
</div>

<?php get_footer(); ?>