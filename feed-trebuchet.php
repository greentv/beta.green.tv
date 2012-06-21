<?php
/**
 * Trebuchet Feed Template.
 *
 * @package WordPress
 */


echo '<?xml version="1.0" encoding="UTF" ?>'; ?>
<trebuchet version="2">
    <header>
        <config>

        </config>
    </header>

    <?php
    /* get all posts */
    $args = array(
        'post_type' => 'woo_video',
        'numberposts' => 9999999999
    );

    $posts = get_posts( $args);
    
    foreach ($posts as $post) {
        $postname = get_the_title($post->ID); ?>
        <asset id="<?php echo $post->ID ?>">
            <?php echo $postname ?>

            <?php
            /* categories relative to post */
            $terms = get_the_terms( $post->ID, 'woo_video_category');
            foreach ( $terms as $term ) {
                echo $term->name;
            }
            ?>
        </asset>
    <?php
    }

    /* all categories */
    /*
    $categories = get_categories( 'taxonomy=woo_video_category' );

    foreach($categories as $category) {
        echo '<cat>'.$category->name.'</cat>';
    }
    */

    ?>



</trebuchet>
