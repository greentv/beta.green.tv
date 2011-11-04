<?php
/**
 * RSS 0.92 Feed Template for displaying RSS 0.92 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
<rss version="0.92">
<channel>
	<title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss('description') ?></description>
	<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<docs>http://backend.userland.com/rss092</docs>
	<language><?php echo get_option('rss_language'); ?></language>
	<?php do_action('rss_head'); ?>

<?php while (have_posts()) : the_post(); ?>
	<item>
		<title><?php the_title_rss() ?></title>
		<guid><?php the_permalink_rss() ?></guid>
		<link><?php the_permalink_rss() ?></link>

        <lb:original_link>http://www.green.tv/</lb:original_link>
        <lb:copyright>green tv</lb:copyright>
        <author>info_NOSPAM@green.tv (Large Blue)</author>

        <pubDate>Wed, 26 Oct 2011 00:00:00 GMT</pubDate>


        <?php /*echo woo_get_video_image()*/ ?>
        <?php
    	// Check if there is YouTube embed
    	
    	$media_file = false;

    	if ( empty($custom_field) && empty($img_link) ) {
    		$embed = get_post_meta($id, "embed", true);
    		
    		
    		if ( $embed ) {
    	    	$custom_field = woo_get_video_code($embed);

    	    	//echo 'http://gdata.youtube.com/feeds/api/videos/' . $custom_field;
                $xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/' . $custom_field);

                foreach($xml->xpath('//media:content') as $content) {
                    $media_file = $content->attributes();
                }
    	    	
//                print_r($media);
                
//    	    	$attrs = $media->media->content->attributes();

    	   }
    	    	
    	}
	?>
		<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>

        <?php if( $media_file ): ?>
        <media:group>
            <media:content lang="en" url="<?php echo $media_file ?>" duration="114" type="video/x-flv" fileSize="14280909"/>
            <media:content lang="en" url="<?php echo $media_file ?>" duration="114" type="video/x-m4v" fileSize="12207328"/>
            <media:content lang="en" url="<?php echo $media_file ?>" duration="114" type="video/mp4" fileSize="5814524"/>
            <media:content lang="en" url="<?php echo $media_file ?>" duration="114" type="video/x-ms-wmv" fileSize="14005157"/>
            <media:content lang="en" url="<?php echo $media_file ?>" duration="114" type="video/x-mp4" fileSize="10653901"/>
            <media:content lang="en" url="<?php echo $media_file ?>" duration="114" type="video/quicktime" fileSize="14184031"/>
            <?php /*
            <media:content lang="en" url="http://static.green.tv/static/videos/news_oct26_11/news_oct26_11.flv" duration="114" type="video/x-flv" fileSize="14280909"/>
            <media:content lang="en" url="http://static.green.tv/static/videos/news_oct26_11/news_oct26_11.m4v" duration="114" type="video/x-m4v" fileSize="12207328"/>
            <media:content lang="en" url="http://static.green.tv/static/videos/news_oct26_11/news_oct26_11.384.mp4" duration="114" type="video/mp4" fileSize="5814524"/>
            <media:content lang="en" url="http://static.green.tv/static/videos/news_oct26_11/news_oct26_11.9.wmv" duration="114" type="video/x-ms-wmv" fileSize="14005157"/>
            <media:content lang="en" url="http://static.green.tv/static/videos/news_oct26_11/news_oct26_11.mp4" duration="114" type="video/x-mp4" fileSize="10653901"/>
            <media:content lang="en" url="http://static.green.tv/static/videos/news_oct26_11/news_oct26_11.mov" duration="114" type="video/quicktime" fileSize="14184031"/>
            */
            ?>
        </media:group>
        <?php endif; ?>
		<?php do_action('rss_item'); ?>
	</item>
<?php endwhile; ?>
</channel>
</rss>
