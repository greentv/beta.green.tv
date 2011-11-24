jQuery(window).load(function() {
    setTimeout(function(){
        // Hide the address bar!
        if( jQuery(document).scrollTop() < 100 )
            window.scrollTo(0, 1);
      }, 0);
});


jQuery(document).ready(function(){
	// Add alt-row styling to tables
	jQuery('.entry table tr:odd').addClass('alt-table-row');
	
	// Remove borders on video sharing links
	jQuery('#feat-video .share li:first-child').addClass('first');
	jQuery('#feat-video .share li:last-child').addClass('last');
	
	// Add "last" class to related videos li
	jQuery('.related-videos ul li:nth-child(3n)').addClass('last');

    if( jQuery('.col-full').eq(0).width() < 960 ) {
	   jQuery('.#main.video-archive .fix').remove();
    }

	jQuery(".slide-overlay-toggle").each(function(){
		
		jQuery(this).click(function(){
			jQuery(this).parent().hide();
		});
		
	});

    var unselectedNavItem = jQuery('ul#main-nav a[href="' + window.location.pathname.toString() + '"]');	
    var unselectedSubNavItem = jQuery('ul#menu-category-menu a[href="' + window.location.pathname.toString() + '"]');

    if( unselectedNavItem.length ) {
        var li_item = unselectedNavItem.closest('li');
        li_item.addClass('current-menu-item');

        if( unselectedNavItem.closest('.sub-menu').length ) {
            li_item.closest('#main-nav>li').addClass('current-menu-item');
        }
    }

    if( unselectedSubNavItem.length ) {
        unselectedSubNavItem.closest('ul#main-nav>li').addClass('current-menu-item');
        unselectedSubNavItem.closest('li').addClass('current-menu-item');
    }
    
    //add vestas link to h3 widget title on homepage
    jQuery('#widget_woo_embed-7 h3').append('<a href="http://www.vestas.com/" target="_blank" title="Vestas"></a>');

    jQuery('#map-choice').each(function(){
        var map = jQuery(this);
        var overlay = jQuery('#map-overlay');
        
        map.fadeIn();
        overlay.fadeTo(0.77);
        
        jQuery('html, body').css({ overflow : 'hidden' });
    });

    /* hover over map */
    jQuery('.world-map').hover(
    function() {
        jQuery('#' + jQuery(this).attr('rel') ).stop().fadeIn(500);
    }, 
    function() {
        jQuery('#' + jQuery(this).attr('rel') ).stop().fadeOut(100);
    });
    
	
});

jQuery('.tab-image-block img').mouseover(function() {
    jQuery(this).stop().fadeTo(400, 0.2);
});
jQuery('.tab-image-block img').mouseout(function() {
    jQuery(this).stop().fadeTo(500, 1.0);
});
