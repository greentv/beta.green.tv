<?php
/**
 * Trebuchet Leaf Feed Template.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);

$args = array('post_type' => 'woo_video', 'numberposts' => 9999999999);
$posts = get_posts( $args);

# function to convert the time format we're supplying to seconds
function timeToSeconds($time) {
    $parts = explode(':', $time);
    $seconds = 0;
    foreach ($parts as $i => $val) {
        $seconds += $val * pow(60, 2 - $i);
    }
    return round($seconds);
}

$post_order_count = 99999;
$default_rating = 'PG';

echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>

<trebuchet version="2.0">
    <mehta_data_version>1</mehta_data_version>
    <assets>
    <?php foreach($posts as $post) { 
    if (get_post_meta($post->ID, 'trebuchet_enabled', true) == 'true') {
    ?>
<asset id="<?php echo $post->ID; ?>">
            <?php $terms = get_the_terms( $post->ID, 'woo_video_category');
            $post_order = get_post_meta($post->ID, 'trebuchet_order', true);
            if ($post_order == '') {
                $post_order_count--;
                $post_order = $post_order_count;
            }
            foreach ( $terms as $term ) {
                echo '<in_category id="'.$term->term_id.'" order="'.$post_order.'" />';
            } ?>
            <type>video</type>
            <default_icons>
                <icon_std><?php 
                $asset_path = get_post_meta($post->ID, 'asset_path', true);
                $base_dir = basename($asset_path);
                echo 'http://static.green.tv/static/videos/'.$base_dir.'/'.$base_dir.'.jpg';
                ?></icon_std>
            </default_icons>
            <languages>
                <language id="en">
                    <title><?php echo the_title_rss(); ?></title>
                    <description><![CDATA[<?php echo the_excerpt_rss(); ?>]]></description>
                </language>
            </languages>
            <asset_url downloadable='false'><?php echo 'http://static.green.tv/static/videos/'.$base_dir.'/'.get_post_meta($post->ID, 'mp4_asset_filename', true); ?></asset_url>
            <rating scheme="urn:mpaa"><?php 
            $rating = get_post_meta($post->ID, 'trebuchet_rating', true);
            if ($rating == '') {
                $rating = $default_rating;
            }
            echo $rating;
            ?></rating>
            <duration><?php echo timeToSeconds(get_post_meta($post->ID, 'mp4_asset_duration', true)); ?></duration>
        </asset>
    <?php } 
    } ?>
    </assets>
</trebuchet>