<?php
/**
 * Trebuchet Feed Template.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);

/* get all the posts */
$args = array('post_type' => 'woo_video', 'numberposts' => 9999999999);
$posts = get_posts( $args);

/* get all the categories */
$categories = get_categories( 'taxonomy=woo_video_category' );

echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<trebuchet version="2">
    <header>
        <config>
            <fallback_language>en</fallback_language>
            <icon_poster>http://www.green.tv/wp-content/uploads/2011/11/gtvlogo.png</icon_poster>
        </config>
    </header>
    <root_category id="1">
        <default_icons>
            <icon_std>http://www.green.tv/wp-content/uploads/2011/11/gtvlogo.png</icon_std> 
        </default_icons>
        <languages>
            <language id="en">
                <title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
                <description><![CDATA[<?php bloginfo_rss('description') ?>]]></description>
            </language>
        </languages>
        <?php foreach($categories as $category) { ?>
<category id="<?php echo $category->term_id; ?>">
            <default_icons>
                <icon_std></icon_std>
            </default_icons>
            <languages>
                <language id="en">
                    <title><?php echo $category->name; ?></title>
                    <description><![CDATA[<?php echo $category->category_description; ?>]]></description>
                </language>
            </languages>
        </category>
        <?php } ?>
    </root_category>
    <assets>
    <?php foreach($posts as $post) { ?>
<asset id="<?php echo $post->ID; ?>">
            <?php $terms = get_the_terms( $post->ID, 'woo_video_category');
            foreach ( $terms as $term ) {
                echo '<in_category id="'.$term->term_id.'" />';
            } ?>
            <type>video</type>
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




    



