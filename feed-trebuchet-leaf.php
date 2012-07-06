<?php
/**
 * Trebuchet Leaf Feed Template.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);

$args = array('post_type' => 'woo_video', 'numberposts' => 9999999999);
$posts = get_posts( $args);
$fallback_icon = 'http://www.green.tv/wp-content/uploads/2011/11/gtvlogo.png';

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
                <icon_std><?php echo isset($custom_fields['trebuchet_icon']) ? $custom_fields['trebuchet_icon'][0] : '' ?></icon_std>
            </default_icons>
            <languages>
                <language id="en">
                    <title><?php echo the_title_rss(); ?></title>
                    <description><![CDATA[<?php echo the_excerpt_rss(); ?>]]></description>
                </language>
            </languages>
        </asset>
    <?php } ?>
    </assets>
</trebuchet>