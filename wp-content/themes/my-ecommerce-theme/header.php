<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head><?php wp_head(); ?></head>
<body <?php body_class(); ?>>
<header>
<h1><?php bloginfo('name'); ?></h1>
<?php wp_nav_menu(['theme_location'=>'primary']); ?>
</header>
<main>