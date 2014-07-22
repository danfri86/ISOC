<!DOCTYPE html>
<html lang="en" class="no-js">

<!--[if IE]>
	<meta http-equiv="imagetoolbar" content="no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
                                                                                                
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<title><?php wp_title(''); ?></title>
	
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    		
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
			
	<?php wp_head(); ?>			
</head>

<body <?php body_class(); ?>>

	<header role="banner">
 		<div class="container">
 			<h1 class="logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/static/logotype.png" alt=""></a></h1>

 			<nav>
 				<span class="mobile-close"><i class="fa fa-times"></i> Stäng</span>
				
				<?php wp_nav_menu(
					array(
						'theme_location' => 'main_nav',
						'container'	=> false,
						'container_class' => '',
						'menu_class'=> '',
						'menu_id'	=> '', // Lämnar id tomt
						'items_wrap'=> '<ul>%3$s</ul>'
					)

					// Sökikonen läggs till sist i menyn från functions.php
				); ?>
 			</nav>

 			<div class="top-menu">
 				<ul>
 					<li><a href="<?php bloginfo('url'); ?>/wp-admin">Medlemslogin</a></li>
 					<?php //<li><a href="!#">Medlemslogin</a></li> ?>
 					<?php //<li><a href="!#">Language <i class="fa fa-globe"></i></a></li> ?>
 				</ul>
 			</div>
 			<span class="mobile-menu"><i class="fa fa-bars"></i> Meny</span>
 		</div>
 			<input id="search" type="text" placeholder="Sök">
 	</header>