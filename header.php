<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap" rel="stylesheet">
	<!-- wordpress管理画面などから設定した内容が反映される -->
	<?php wp_head(); ?>
	<script src="https://kit.fontawesome.com/8398227d24.js" crossorigin="anonymous"></script>
</head>
<body <?php body_class( 'c-bg' ); ?>>