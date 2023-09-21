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
                ?>

                <!-- start:row -->
                <div class="row">

                    <div class="col-12 col-md-4">

                        <h2>Previously Funded Projects</h2>

                        <div class="text">
                            <p>Discover the impactful projects that have received support through Retroactive Public Goods Funding (RetroPGF). These initiatives have demonstrated a commitment to driving positive change in the Optimism Collective.</p>
                        </div>

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