<?php

$categoryID = 5;

$queryArgs = array(
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $categoryID,
        )
    ),
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_status' => 'publish'
);

$query = new WP_Query($queryArgs);

$introData = getSpecificPostDataByCategory('post', 6);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:home-about -->
    <div class="home-about">

        <!-- start:container -->
        <div class="container">

            <?php while ($query->have_posts()): ?>

                <?php
                // Prepare data
                $query->the_post();
                $postID = get_the_ID();

                $thumbID = get_post_thumbnail_id();
                $image = wp_get_attachment_image_src($thumbID, 'theme-thumb-1');
                $imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);

                $round_1_text = get_field('round_1_text', $postID);
                $round_2_text = get_field('round_2_text', $postID);
                $round_3_text = get_field('round_3_text', $postID);
                ?>

                <h2><?php echo get_the_title(); ?></h2>

                <div class="text">
                    <?php the_content(); ?>
                </div>

                <div class="row g-5">
                    <div class="col-12 col-md-4">
                        <h3><?php _e('Round 1', 'retro'); ?></h3>
                        <?php echo $round_1_text; ?>
                    </div>
                    <div class="col-12 col-md-4">
                        <h3><?php _e('Round 2', 'retro'); ?></h3>
                        <?php echo $round_2_text; ?>
                    </div>
                    <div class="col-12 col-md-4">
                        <h3><?php _e('Round 3', 'retro'); ?></h3>
                        <?php echo $round_3_text; ?>
                    </div>
                </div>
            <?php endwhile; ?>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-about -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>