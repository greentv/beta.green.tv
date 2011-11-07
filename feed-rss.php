<?php
    include (TEMPLATEPATH . '/includes/youtube/config.php');
    include (TEMPLATEPATH . '/includes/youtube/curl.php');
    include (TEMPLATEPATH . '/includes/youtube/youtube.php');
?>
<?php
/**
 * RSS 0.92 Feed Template for displaying RSS 0.92 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss" xmlns:lb="http://www.largeblue.com">
<channel>
    <title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
    <link><?php bloginfo_rss('url') ?></link>
    <description><?php bloginfo_rss('description') ?></description>
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
    <language><?php echo get_option('rss_language'); ?></language>
    <?php do_action('rss_head'); ?>

<?php while (have_posts()) : the_post(); ?>
    <item>
        <title><?php the_title_rss() ?></title>
        <?php $custom_fields = get_post_custom(); ?>
        <guid><?php echo isset($custom_fields['video_guid']) ? $custom_fields['video_guid'][0] : esc_url( apply_filters('the_permalink_rss', get_permalink() )) ?></guid>
        <link><?php the_permalink_rss() ?></link>

        <lb:original_link>http://www.green.tv/</lb:original_link>
        <lb:copyright>green tv</lb:copyright>
        <author>info_NOSPAM@green.tv (Large Blue)</author>

        <pubDate><?php the_time('D, d M Y H:i:s e'); ?></pubDate>

        <description><![CDATA[<?php the_excerpt_rss() ?>]]></description>

        <media:group>
            <?php
            $media_file = false;
            $valid_media = array('video/x-flv', 'video/x-m4v', 'video/mp4', 'video/x-ms-wmv', 'video/x-mp4', 'video/quicktime', 'video/3gpp');
    
            if ( empty($custom_field) && empty($img_link) ) {
                $embed = get_post_meta($id, "embed", true);

                if ( $embed ) {
                    $yt_id  = woo_get_video_code($embed);
/** haxor attempt
                    $content = file_get_contents("http://youtube.com/get_video_info?video_id=".$custom_field);
                    $ytfmt = array('35','22');
                    parse_str($content, $ytfmt);

                    print_r($content);
/**/

                    $xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/' . $yt_id );
                    $length = 0;

                    foreach($xml->xpath('//media:content') as $content) {
                        $media_file = $content->attributes();
                        if( in_array($media_file->type, $valid_media) ) {
                            // remove from media list to avoid duplicates
                            unset($valid_media[array_search($media_file->type, $valid_media)]);
                            echo '<media:content lang="en" url="' . $media_file->url . '" duration="' . $media_file->duration . '" type="' . $media_file->type . '" fileSize=""/>';
                            $length = $media_file->duration;
                        }
                    }

/**/
                    $_REQUEST['url'] = 'http://www.youtube.com/watch?feature=player_embedded&v=pyRGi2jbBto';
                    if (isset($_REQUEST['url']) && !empty($_REQUEST['url'])) {
                        $url = $_REQUEST['url'];
                        $parts = parse_url($url);
                        $host = $parts['host'];
                        $service = strtolower($host);
                        $host_parts = explode('.',$service);
                        $service = $host_parts[count($host_parts)-2];
                    
                        $obj = new $service();
                    
                        if(isset($obj->src) && (!isset($_POST['src']) || empty($_POST['src'])) && !$stream) {
                            $sourceRequired = true;
                        } else {  
                            $obj->stream = $stream;
                            $videos = $obj->get($url);
                    
                        }
                    
                        foreach ($videos as $video) {
                            echo '<media:content lang="en" url="' . get_bloginfo('template_directory') . '/includes/youtube/' . $video['url'] . '" duration="' . $length . '" type="' . $video['ext'] . '" fileSize=""/>';
                        }
                    
                    }
/**/
               }
            }
            ?>

        </media:group>
        <?php do_action('rss_item'); ?>

        <media:keywords><?php
            $terms = get_the_terms( $id, 'post_tag' );
            $count = 0;
            foreach ( $terms as $term ) {
                if( $count++ )
                    echo ', ';
                echo $term->name;
            }
            ?></media:keywords>
    </item>
<?php endwhile; ?>
</channel>
</rss>
