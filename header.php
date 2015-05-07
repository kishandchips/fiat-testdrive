<!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta name="format-detection" content="telephone=no">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />     
	
	<?php wp_head(); ?>	
	<!--[if lt IE 8]> <script src="<?php bloginfo('template_url')?>/js/lte-ie7.js"></script> <![endif]-->
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url')?>/css/ie.css" />
	<![endif]-->
    <script type="text/javascript">
		var themeUrl = '<?php bloginfo( 'template_url' ); ?>';
		var baseUrl = '<?php bloginfo( 'url' ); ?>';
	</script>	
</head>

<body <?php body_class(); ?>>
	<div id="wrap">
		<div class="wrap-inner clearfix">
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
					<span>0843 393 2110</span>
					<a class="scroll-to-btn" href="#start" data-icon="3"></a href="#top">
				</h2>						
			</div>
		</header><!-- #masthead -->
		<div id="main" role="main">