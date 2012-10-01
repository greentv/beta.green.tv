<?php

#ini_set('error_repor#ting', E_ALL);
#ini_set('display_errors', 'On');
#ini_set('display_startup_errors', 'On');

/**
 * Trebuchet Branch Feed Template.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);

$categories = get_categories( 'taxonomy=woo_video_category' );
# featured 515, latest 529, technology 49, climate change 11, water 80, business 3, living 20, nature 55, people 33, transport 42, air 82, sony 512, ashden 275
$included_categories = array(515, 529, 49, 11, 80, 3, 20, 55, 33, 42, 82, 512, 275);

echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<trebuchet version="2">
    <mehta_data_version>1</mehta_data_version>
    <header>
        <config>
            <fallback_language>en</fallback_language>
            <icon_poster>http://feeds.largeblue.net/sony/default_icon.jpg</icon_poster>
        </config>
    </header>
    <supported_features>
        <icon_formats>std</icon_formats>
    </supported_features>
    <root_category id="1" style="row">
        <default_icons>
            <icon_std>http://feeds.largeblue.net/sony/gtv_sonytv_thumbnail_128x96_greentv.jpg</icon_std>
        </default_icons>
        <languages>
            <language id="en">
                <title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
                <description><![CDATA[<?php echo bloginfo_rss('description') ?>]]></description>
            </language>
        </languages>
        <?php foreach($categories as $category) { 
            if(in_array($category->term_id, $included_categories)) {
            ?>
            <category style="row" order="<?php echo (array_search($category->term_id, $included_categories) + 1); ?>" id="<?php echo $category->term_id; ?>">
                <default_icons>
                    <icon_std>http://static.green.tv/static/categories/<?php echo $category->slug; ?>/gtv_sonytv_thumbnail_128x96_<?php echo $category->slug; ?>.jpg</icon_std>
                </default_icons>
                <languages>
                    <language id="en">
                        <title><?php echo $category->name; ?></title>
                        <description><![CDATA[<?php echo (strlen($category->category_description) > 0) ? $category->description : $category->name.' channel'; ?>]]></description>
                    </language>
                </languages>
            </category>
            <?php
            }
        } ?>
    </root_category>
</trebuchet>