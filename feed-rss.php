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
        <guid><?php the_permalink_rss() ?></guid>
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
                    $custom_field = woo_get_video_code($embed);

                    $xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/' . $custom_field);

                    foreach($xml->xpath('//media:content') as $content) {
                        $media_file = $content->attributes();
                        if( in_array($media_file->type, $valid_media) ) {
                            // remove from media list to avoid duplicates
                            unset($valid_media[array_search($media_file->type, $valid_media)]);
                            echo '<media:content lang="en" url="' . $media_file->url . '" duration="' . $media_file->duration . '" type="' . $media_file->type . '" fileSize=""/>';
                        }
                    }
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
