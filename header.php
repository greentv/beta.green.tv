<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<?php global $woo_options; ?>

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( $woo_options['woo_feed_url'] ) { echo $woo_options['woo_feed_url']; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
      
<?php wp_head(); ?>
<?php woo_head(); ?>

<!--[if IE 6]>
<script type="text/javascript"> 
	/*Load jQuery if not already loaded*/ if(typeof jQuery == 'undefined'){ document.write("<script type=\"text/javascript\"   src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js\"></"+"script>"); var __noconflict = true; } 
	var IE6UPDATE_OPTIONS = {
		icons_path: "<?php echo bloginfo('template_directory'); ?>/ie6update/images/"
	}
</script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory'); ?>/ie6update/ie6update.js"></script>
<![endif]-->

</head>

<body <?php body_class(); ?>>
<?php woo_top(); ?>

<div id="wrapper">

	<div id="header">
           
		<div id="header-top">
			<div class="col-full">
            	<?php if ( function_exists( 'has_nav_menu') && has_nav_menu( 'top-menu') ) : ?>
            	<div id="top">
                    <?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) ); ?>
            	</div><!-- /#top -->
                <?php endif; ?>

				<div id="logo">
				<?php if ($woo_options['woo_texttitle'] <> "true") : $logo = $woo_options['woo_logo']; ?>
					<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
						<img src="<?php if ($logo) echo $logo; else { bloginfo('template_directory'); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" />
					</a>
		        <?php endif; ?> 

		        <?php if( is_singular() && !is_front_page() ) : ?>
					<span class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
		        <?php else : ?>
					<h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		        <?php endif; ?>
				</div><!-- /#logo -->
			</div>
		</div><!-- /#header-top -->  

        <div class="col-full">
            <div id="main-navigation">
    			<div id="search-top">
    				<?php get_template_part( 'search-form' ); ?>
    			</div>
    		<?php
    		if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
    			wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
    		} else {
    		?>
    	        <ul class="nav">
    				<?php 
    	        	if ( isset($woo_options['woo_custom_nav_menu']) AND $woo_options['woo_custom_nav_menu'] == 'true' ) {
    	        		if ( function_exists('woo_custom_navigation_output') )
    						woo_custom_navigation_output();
    				} else { ?>
    		            <?php if ( is_page() ) $highlight = "page_item"; else $highlight = "page_item current_page_item"; ?>
    		            <li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'woothemes') ?></a></li>
    		            <?php 
    		    			wp_list_pages('sort_column=menu_order&depth=6&title_li=&exclude='); 
    				}
    				?>
    	        </ul><!-- /#nav -->
            <?php } ?>
            </div><!-- /#main-nav -->
        </div>

	</div><!-- /#header -->

	<div class="col-full">
		<?php /*if (function_exists('iinclude_page')) iinclude_page(246); */?>
        <div id="social-links">
            <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_tweet" tw:via="addthis"></a>
                <a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:action="recommend"></a>
                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            </div>
            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e8ed6ae71ce286b"></script>
        </div>
		<div id="tagline">
			<span class="site-description"><?php bloginfo('description'); ?></span>
		</div>
	</div>