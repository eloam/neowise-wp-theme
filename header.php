<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <?php wp_head(); ?>
</head>
<body <?php body_class('antialiased bg-gray-100'); ?>>

    <header class="site-header">
        <?php NwComponents::call('menus/header-menu'); ?>
    </header>

    <?php wp_body_open(); ?>
