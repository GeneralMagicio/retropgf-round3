<?php

$categoryID = 18;

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
    'posts_per_page' => 1,
    'post_status' => 'publish',
);

$query = new WP_Query($queryArgs);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:home-footer -->
    <div class="home-footer">

        <!-- start:container -->
        <div class="container">

            <div class="home-footer-inner">

                <div class="row">

                    <?php while ($query->have_posts()): ?>

                        <?php
                        // Prepare data
                        $query->the_post();
                        $postID = get_the_ID();

                        $thumbID = get_post_thumbnail_id();
                        $image = wp_get_attachment_image_src($thumbID, 'theme-thumb-1');
                        $imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);

                        $link = get_field('link', $postID);
                        ?>

                        <div class="col-12">
                            <?php if( isset($image[0]) ): ?>
                                <div class="image-holder">
                                    <img src="<?php echo $image[0]; ?>" alt="<?php echo $imageAlt; ?>">
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php endwhile; ?>

                </div>

            </div>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-footer -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>