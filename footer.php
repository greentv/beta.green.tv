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
        <p>
            It looks like this is the first time you're visiting green.tv, which site would you like?
            <br />
            <div style="text-align : center">
                <a class="button submit" href="?set_location=en">UK</a>
                <a class="button submit" href="http://sp.green.tv?set_location=sp">South Pacific</a>
            </div>
        </p>

        <div id="map-container">
            <img src="<?php bloginfo( 'template_directory' ); ?>/images/world.png" alt="World map" />
        </div>
    </div>
<?php endif; ?>
</body>
</html>