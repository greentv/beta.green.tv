<?php global $woo_options; ?>

	<?php 
		$total = $woo_options[ 'woo_footer_sidebars' ]; if (!isset($total)) $total = 4;				   
		if ( ( woo_active_sidebar( 'footer-1') ||
			   woo_active_sidebar( 'footer-2') || 
			   woo_active_sidebar( 'footer-3') || 
			   woo_active_sidebar( 'footer-4') ) && $total > 0 ) : 
		
  	?>
	<div id="footer-widgets" class="col-<?php echo $total; ?>">		
		<div id="footer-wrapper">
			<?php $i = 0; while ( $i < $total ) : $i++; ?>			
				<?php if ( woo_active_sidebar( 'footer-'.$i) ) { ?>
	
			<div class="block footer-widget-<?php echo $i; ?>">
	        	<?php woo_sidebar( 'footer-'.$i); ?>    
			</div>
			        
		        <?php } ?>
			<?php endwhile; ?>	        		        
			<div class="fix"></div>
		</div><!-- #wrapper -->
	</div><!-- /#footer-widgets  -->
    <?php endif; ?>
</div><!-- /#wrapper -->

<div id="footer">
    <div class="col-full">
        <div id="copyright" class="col-left">
    	<?php if($woo_options[ 'woo_footer_left' ] == 'true'){
    	
    			echo stripslashes($woo_options[ 'woo_footer_left_text' ]);	
    
    	} else { ?>
    		<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ) ?></p>
    	<?php } ?>
    	</div>
    	
    	<div id="credit" class="col-right">
        <?php if($woo_options[ 'woo_footer_right' ] == 'true'){
    	
        	echo stripslashes($woo_options[ 'woo_footer_right_text' ]);
       	
    	} else { ?>
    		<!--<p><?php _e( 'Powered by', 'woothemes' ) ?> <a href="http://www.wordpress.org">WordPress</a>. <?php _e( 'Designed by', 'woothemes' ) ?> <a href="<?php $aff = $woo_options[ 'woo_footer_aff_link' ]; if(!empty($aff)) { echo $aff; } else { echo 'http://www.woothemes.com'; } ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/images/woothemes.png" width="74" height="19" alt="Woo Themes" /></a></p>-->
    	<?php } ?>
    	</div>
    </div>
	
</div><!-- /#footer  -->

<?php wp_footer(); ?>
<?php woo_foot(); ?>
<?php
if ( !isset($_COOKIE['greentv_location']) || $_COOKIE['greentv_location'] == 'unknown' || $_GET['set_location'] == 'undefined' ) :
?>
    <div id="map-overlay"></div>
    <div id="map-choice">
        <img src="<?php bloginfo( 'template_directory' ); ?>/images/world.png" alt="World map" />       
        <div id="world-en"></div>
        <div id="world-sp"></div>

        <img src="<?php bloginfo( 'template_directory' ); ?>/images/trans.png" id="trans-map" width="700" height="476" usemap="#image_map" />

        <map name="image_map" id="image_map">
            <area href="?set_location=en" shape="poly" coords=" 1,1, 576,1, 646,25, 634,44, 668,48, 681,46, 690,57, 697,100, 629,141, 607,126, 514,150, 467,198, 461,210, 448,211, 452,301, 399,315, 366,327, 344,300, 348,272, 332,249, 294,243, 279,210, 304,147, 309,112, 325,99, 367,50, 392,50, 413,66, 424,54, 438,17, 429,6, 296,8, 289,67, 305,77, 302,93, 285,100, 273,75, 259,86, 250,102, 236,107, 218,72, 209,91, 208,107, 230,146, 227,152, 182,191, 203,214, 214,233, 239,240, 239,249, 265,261, 257,278, 250,300, 200,366, 205,379, 191,385, 180,367, 188,287, 172,259, 174,236, 113,204, 83,165, 64,110, 35,101, 14,123, 2,130, 4,63, 26,47, 61,56, 79,56, 93,5" class="world-map" rel="world-en" alt="red hotspot"/>
            <area href="http://sp.green.tv?set_location=sp" shape="poly" coords=" 456,303, 454,215, 465,215, 518,154, 608,131, 628,150, 597,183, 579,199, 568,209, 582,242, 606,256, 621,255, 645,268, 618,276, 624,289, 629,315, 677,332, 659,362, 642,352, 662,335, 627,319, 617,345, 610,340, 600,328, 583,316, 550,327, 548,295, 573,281, 535,265, 512,245, 514,224, 502,210, 483,225, 488,240, 477,233, 467,218" rel="world-sp" class="world-map" alt="green hotspot"/>
        </map>
    </div>
<?php endif; ?>
</body>
</html>