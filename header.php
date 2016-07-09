<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

    <head>

		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php al3_custom_title(); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>

        <?php // Apple Touch Icons ?>
        <!-- Default -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-icon-touch.png">
        <!-- Default with Sizes -->
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-touch-icon-60x60.png">
        <!-- non-retina iPhone before iOS 7 -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-touch-icon-57x57.png">
        <!-- non-retina iPad before iOS 7 -->
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-touch-icon-72x72.png">
        <!-- non-retina iPad iOS 7 -->
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-touch-icon-76x76.png">
        <!-- retina iPhone before iOS 7 -->
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-touch-icon-114x114.png">
        <!-- retina iPhone iOS 7 -->
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-touch-icon-120x120.png">
        <!-- retina iPad before iOS 7 -->
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-touch-icon-144x144.png">
        <!-- retina iPad iOS 7 -->
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-touch-icon-152x152.png">
        <!-- retina iPad iOS 7 for iPhone 6 Plus -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/apple-touch-icon-180x180.png">

        <?php // Apple Application Name ?>
        <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">

        <?php // Android Chrome Icons ?>
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/android-chrome-36x36.png" sizes="36x36">
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/android-chrome-48x48.png" sizes="48x48">
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/android-chrome-72x72.png" sizes="72x72">
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/android-chrome-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/android-chrome-144x144.png" sizes="144x144">
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/android-chrome-192x192.png" sizes="192x192">
        <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/manifest.json">
        <meta name="application-name" content="<?php bloginfo('name'); ?>">

        <?php // MS Tiles ?>
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/favicons/mstile-70x70.png">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/favicons/mstile-144x144.png">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/favicons/mstile-150x150.png">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/favicons/mstile-310x150.png">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/favicons/mstile-310x310.png">
		<meta name="msapplication-TileColor" content="#537c94">

        <?php // MS IE Configuration ?>
        <meta name='msapplication-navbutton-color' content='#537c94'>
        <meta name="theme-color" content="#ffffff">
        <meta name="application-name" content="<?php bloginfo('name'); ?>" />
        <meta name="msapplication-notification" content="frequency=30;polling-uri=http://notifications.buildmypinnedsite.com/?feed=http://stammalexanderlion.de/feed/&amp;id=1;polling-uri2=http://notifications.buildmypinnedsite.com/?feed=http://stammalexanderlion.de/feed/&amp;id=2;polling-uri3=http://notifications.buildmypinnedsite.com/?feed=http://stammalexanderlion.de/feed/&amp;id=3;polling-uri4=http://notifications.buildmypinnedsite.com/?feed=http://stammalexanderlion.de/feed/&amp;id=4;polling-uri5=http://notifications.buildmypinnedsite.com/?feed=http://stammalexanderlion.de/feed/&amp;id=5; cycle=1"/>
        <meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/library/images/favicons/browserconfig.xml">

        <?php // Favicons ?>
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/favicon-194x194.png" sizes="194x194">
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicons/favicon-16x16.png" sizes="16x16">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php // Google Fonts Prefatch ?>
        <link rel="dns-prefetch" href="//fonts.googleapis.com/">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

    <div id="background-wrap">
    <?php // iOS Background Hack ?>

		<div id="container">

			<header class="header">

				<div id="inner-header" class="cf is-fixed">

					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
<!--					<p id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>-->

					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>

                    <a id="logo" href="<?php echo home_url(); ?>" rel="nofollow">
                        <?php bloginfo('name'); ?>
                    </a>

                    <nav itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'The Main Menu', 'al3' ),  // nav name
    					         'menu_class' => 'nav top-nav cf',               // adding custom nav class
    					         'theme_location' => 'lateral-nav',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 0,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>

					</nav>

                    <a href="#0" id="menu-trigger">
                        <span class="menu-text h4"><?php _e('Menu', 'al3'); ?></span>
                        <span class="menu-icon"></span>
                    </a>

				</div><!-- end #inner-header -->

			</header>
