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
        $custom_fields = get_post_custom($post->ID); ?>
<asset id="<?php echo $post->ID; ?>">
            <?php $terms = get_the_terms( $post->ID, 'woo_video_category');
            foreach ( $terms as $term ) {
                echo '<in_category id="'.$term->term_id.'" />';
            } ?>
            <type>video</type>
            <default_icons>
                <icon_std>
                <?php foreach ( $custom_fields['asset_path'] as $key => $value ) {
                    $base_dir = basename($value);
                    echo 'http://static.green.tv/static/videos/'.$base_dir.'/'.$base_dir.'.jpg';
                    break;
                } ?>
                </icon_std>
            </default_icons>
            <languages>
                <language id="en">
                    <title><?php echo the_title_rss(); ?></title>
                    <description><![CDATA[<?php echo the_excerpt_rss(); ?>]]></description>
                </language>
            </languages>
            <asset_url downloadable='false'>
            <?php foreach ( $custom_fields['mp4_asset_filename'] as $key => $value ) {
                echo 'http://static.green.tv/static/videos/'.$base_dir.'/'.$value;
                break;
            } ?>
            </asset_url>
            <rating scheme="">
            <?php foreach( $custom_fields['trebuchet_rating'] as $key => $value) {
                echo $value;
                break;
            } ?>
            </rating>
            <duration>
            <?php foreach( $custom_fields['mp4_asset_duration'] as $key => $value) {
            echo timeToSeconds($value);
            break;
            } ?>
            </duration>
        </asset>
    <?php } ?>
    </assets>
</trebuchet>