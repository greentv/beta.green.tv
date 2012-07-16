<?php

ini_set('error_repor#ting', E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');

/**
 * Trebuchet Branch Feed Template.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);

$categories = get_categories( 'taxonomy=woo_video_category' );
$category_count = 0;

echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<trebuchet version="2">
    <mehta_data_version>1</mehta_data_version>
    <header>
        <config>
            <fallback_language>en</fallback_language>
            <icon_poster>http://www.green.tv/wp-content/uploads/2011/11/gtvlogo.png</icon_poster>
        </config>
    </header>
    <supported_features><icon_formats>std</icon_formats></supported_features>
    <root_category id="1" style="tile">
        <default_icons>
            <icon_std>http://www.green.tv/wp-content/uploads/2011/11/gtvlogo.png</icon_std> 
        </default_icons>
        <languages>
            <language id="en">
                <title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
                <description><![CDATA[<?php echo bloginfo_rss('description') ?>]]></description>
            </language>
        </languages>
        <?php foreach($categories as $category) { 
            $category_count++; ?>
<category style="tile" order="<?php echo $category_count; ?>" id="<?php echo $category->term_id; ?>">
            <default_icons>
                <icon_std>http://static.green.tv/static/categories/<?php echo $category->slug; ?>/<?php echo $category->slug; ?>.jpg</icon_std>
            </default_icons>
            <languages>
                <language id="en">
                    <title><?php echo $category->name; ?></title>
                    <description>
                    <![CDATA[<?php 
                        echo (strlen($category->category_description) > 0) ? $category->description : 'The '.$category->name.' category'; 
                    ?>]]>
                </description>
                </language>
            </languages>
        </category>
        <?php } ?>
    </root_category>
</trebuchet>