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
    return $seconds;
}

echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>

<trebuchet version="2.0">
    <mehta_data_version>1</mehta_data_version>
    <assets>
    <?php foreach($posts as $post) { 
    if (get_post_meta($post->ID, 'trebuchet_enabled', true) == 'true') {
    ?>
<asset id="<?php echo $post->ID; ?>">
            <?php $terms = get_the_terms( $post->ID, 'woo_video_category');
            foreach ( $terms as $term ) {
                echo '<in_category id="'.$term->term_id.'" />';
            } ?>
            <type>video</type>
            <default_icons>
                <icon_std><?php echo get_post_meta($post->ID, 'asset_path', true); ?></icon_std>
            </default_icons>
            <languages>
                <language id="en">
                    <title><?php echo the_title_rss(); ?></title>
                    <description><![CDATA[<?php echo the_excerpt_rss(); ?>]]></description>
                </language>
            </languages>
            <asset_url downloadable='false'>
            <?php echo get_post_meta($post->ID, 'mp4_asset_filename', true); ?>
            </asset_url>
            <rating scheme=""><?php echo get_post_meta($post->ID, 'trebuchet_rating', true); ?></rating>
            <duration><?php echo timeToSeconds(get_post_meta($post->ID, 'mp4_asset_duration', true)); ?></duration>
        </asset>
    <?php } 
    } ?>
    </assets>
</trebuchet>