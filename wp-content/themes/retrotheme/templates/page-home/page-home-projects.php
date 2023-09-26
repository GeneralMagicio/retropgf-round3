<?php

$categoryID = 8;

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
    'posts_per_page' => 12,
    'post_status' => 'publish',
    'post__in' => get_option('sticky_posts'),
    'ignore_sticky_posts' => 1,
);

$query = new WP_Query($queryArgs);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:home-projects -->
    <div class="home-projects project-list">

        <!-- start:container -->
        <div class="container">

            <div class="row g-0 g-md-4">

                <?php while ($query->have_posts()): ?>

                    <?php
                    // Prepare data
                    $query->the_post();
                    $postID = get_the_ID();

                    $thumbID = get_post_thumbnail_id();
                    $image = wp_get_attachment_image_src($thumbID, 'full');
                    $imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);

                    $project_short_description = get_field('project_short_description', $postID);
                    ?>

                    <div class="col-12 col-sm-6 col-md-3 mb-4 mb-md-0">
                        <a href="<?php echo get_category_link(8); ?>" title="<?php the_title(); ?>" class="project-link">
                            <span class="project-link-top">
                                <?php if( isset($image[0]) ): ?>
                                    <span class="image" style="background-image: url(<?php echo $image[0]; ?>);"></span>
                                <?php endif; ?>
                            </span>
                            <span class="title"><?php the_title(); ?></span>
                            <span class="text">
                                <?php echo $project_short_description; ?>
                            </span>
                        </a>
                    </div>

                <?php endwhile; ?>

            </div>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-projects -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>