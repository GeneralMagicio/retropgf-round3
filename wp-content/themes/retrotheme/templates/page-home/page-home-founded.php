<?php

$categoryID = 6;

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

    <!-- start:home-founded -->
    <div class="home-founded">

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

                $link = get_field('link', $postID);
                ?>

                <!-- start:row -->
                <div class="row">

                    <div class="col-12 col-md-4">

                        <h2><?php the_title(); ?></h2>

                        <div class="text">
                            <?php the_content(); ?>
                        </div>

                        <?php if (isset($link['url'])): ?>
                            <div class="link">
                                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ?>" class="btn"><?php echo $link['title']; ?></a>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
                <!-- end:row -->
            <?php endwhile; ?>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:home-founded -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>