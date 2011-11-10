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
            <area href="?set_location=en" shape="poly" coords="26,47, 64,63, 78,52, 84,27, 89,14, 105,1, 295,0, 543,1, 553,28, 549,37, 579,30, 599,14, 626,27, 615,42, 642,47, 651,54, 673,55, 687,45, 684,68, 698,76, 695,88, 650,114, 636,143, 624,114, 603,127, 611,146, 619,169, 597,181, 585,196, 570,192, 568,219, 577,236, 587,249, 602,253, 604,271, 577,270, 539,270, 511,244, 517,231, 504,210, 487,223, 488,241, 481,242, 467,219, 463,207, 441,202, 447,209, 436,222, 417,229, 428,230, 404,261, 409,277, 426,277, 421,301, 418,303, 413,291, 407,284, 398,294, 398,305, 392,306, 384,324, 360,325, 348,282, 345,244, 311,247, 293,224, 297,195, 317,176, 309,171, 311,158, 327,158, 311,133, 312,108, 337,98, 361,65, 383,52, 408,70, 430,53, 427,44, 447,18, 464,10, 295,6, 283,63, 284,81, 300,78, 307,89, 293,97, 276,87, 277,66, 243,105, 206,83, 203,109, 225,146, 181,177, 174,201, 207,216, 229,241, 234,253, 262,263, 252,281, 248,300, 238,304, 195,371, 204,380, 193,383, 179,366, 191,286, 176,279, 169,259, 176,239, 166,236, 146,219, 136,221, 89,172, 87,140, 65,109, 38,102, 4,131, 2,64, 24,47" class="world-map" rel="world-en" alt="red hotspot"/>
            <area href="http://sp.green.tv?set_location=sp" shape="poly" coords=" 62,474, 85,464, 121,468, 125,456, 178,458, 184,440, 219,406, 213,472, 285,473, 297,457, 328,439, 394,439, 431,424, 480,439, 490,424, 585,422, 646,450, 659,454, 649,475, 698,474, 698,338, 671,338, 657,357, 650,353, 663,322, 648,292, 628,303, 615,348, 587,319, 551,327, 546,295, 580,274, 607,274, 604,252, 698,256, 698,337" rel="world-sp" class="world-map" alt="green hotspot"/>
        </map>
    </div>
<?php endif; ?>
</body>
</html>