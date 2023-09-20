<?php

$categoryID = 9;

if (function_exists('wpml_object_id_filter')) {
    $categoryID = wpml_object_id_filter($categoryID, 'category', false);
}

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
    'post_status' => 'publish'
);

$query = new WP_Query($queryArgs);

$introData = getSpecificPostDataByCategory('post', 6);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:home-advantages -->
    <div class="home-advantages">

        <!-- start:container -->
        <div class="container">

            <?php while ($query->have_posts()): ?>

                <?php
                // Prepare data
                $query->the_post();
                $postID = get_the_ID();

                $first_title = get_field('first_title', $postID);
                $first_text = get_field('first_text', $postID);
                $second_title = get_field('second_title', $postID);
                $second_text = get_field('second_text', $postID);
                $third_title = get_field('third_title', $postID);
                $third_text = get_field('third_text', $postID);
                ?>

                <div class="home-advantages-intro">
                    <h2><?php the_title(); ?></h2>
                    <div class="text">
                        <?php the_content(); ?>
                    </div>
                </div>

                <div class="boxes">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-lg-auto mb-5 order-0">
                            <img src="<?php echo TEMPLATEDIR; ?>/images/icon-location.svg" alt="">
                        </div>
                        <div class="col-12 col-lg-auto mb-5 order-3 order-lg-0">
                            <img src="<?php echo TEMPLATEDIR; ?>/images/dots.svg" alt="">
                        </div>
                        <div class="col-12 col-lg-auto mb-5 order-4 order-lg-0">
                            <img src="<?php echo TEMPLATEDIR; ?>/images/icon-idea.svg" alt="">
                        </div>
                        <div class="col-12 col-lg-auto mb-5 order-6 order-lg-0">
                            <img src="<?php echo TEMPLATEDIR; ?>/images/dots.svg" alt="">
                        </div>
                        <div class="col-12 col-lg-auto mb-5 order-7 order-lg-0">
                            <img src="<?php echo TEMPLATEDIR; ?>/images/icon-person.svg" alt="">
                        </div>
                        <div class="col-12 order-9 order-lg-0"></div>
                        <?php if ($first_title): ?>
                            <div class="col-12 col-lg-3 mb-4 box-holder item-1 order-1 order-lg-0">
                                <h3><?php echo $first_title; ?></h3>
                                <div>
                                    <?php echo $first_text; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($second_title): ?>
                            <div class="col-12 col-lg-3 mb-4 box-holder item-2 order-5 order-lg-0">
                                <h3><?php echo $second_title; ?></h3>
                                <div>
                                    <?php echo $second_text; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($third_title): ?>
                            <div class="col-12 col-lg-3 mb-4 box-holder item-3 order-8 order-lg-0">
                                <h3><?php echo $third_title; ?></h3>
                                <div>
                                    <?php echo $third_text; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endwhile; ?>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-advantages -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>