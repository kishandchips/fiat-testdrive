<!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />     
	<?php 
		function load_assets(){
			wp_enqueue_style('style', get_template_directory_uri().'/css/style.css');

			wp_enqueue_script('modernizr', get_template_directory_uri().'/js/libs/modernizr.min.js');
			wp_enqueue_script('jquery', get_template_directory_uri().'/js/libs/jquery.min.js');
			wp_enqueue_script('selecter', get_template_directory_uri().'/js/plugins/jquery.fs.selecter.min.js');
			wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array('jquery'), '', true);
		}
		add_action('wp_enqueue_scripts', 'load_assets');
	?>
	<!--[if lt IE 8]> <script src="<?php bloginfo('template_url')?>/js/lte-ie7.js"></script> <![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="wrap">
		<header id="header" role="banner">
			<div class="container">
				<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
				<h1 class="title">
					<?php bloginfo( 'name' ); ?>
				</h1>
				<h2 class="tagline">
					<?php bloginfo( 'description' ); ?>
					<span data-icon="3"></span>
				</h2>						
			</div>
		</header><!-- #masthead -->
		<div id="main" role="main">
			<div class="bg-montage hide-on-mobile"></div>