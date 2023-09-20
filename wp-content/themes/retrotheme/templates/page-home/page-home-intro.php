<?php

$categoryID = 5;

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
    'posts_per_page' => -1,
    'post_status' => 'publish'
);

$query = new WP_Query($queryArgs);

$introData = getSpecificPostDataByCategory('post', 6);
?>

<?php if ($query->have_posts()): ?>

    <!-- start:home-intro -->
    <div class="home-intro">

        <!-- start:container -->
        <div class="container-fluid">

            <!-- start:row -->
            <div class="row align-items-center g-0">

                <div class="col-12 col-lg-9 col-xl-6 ms-auto">

                    <div id="carouserIntro" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $queryCounter = 1; ?>

                            <?php while ($query->have_posts()): ?>

                                <?php
                                // Prepare data
                                $query->the_post();
                                $postID = get_the_ID();

                                $thumbID = get_post_thumbnail_id();
                                $image = wp_get_attachment_image_src($thumbID, 'theme-thumb-1');
                                $imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);
                                ?>

                                <div class="carousel-item <?php echo ($queryCounter == 1) ? 'active' : ''; ?>">
                                    <?php if (isset($image[0])): ?>
                                        <img src="<?php echo $image[0]; ?>" alt="<?php echo $imageAlt; ?>"
                                             class="img-responsive">
                                    <?php endif; ?>
                                </div>

                                <?php $queryCounter++; ?>
                            <?php endwhile; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouserIntro"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouserIntro"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>

            </div>
            <!-- end:row -->

        </div>
        <!-- end:container -->

        <?php if ($introData): ?>
            <?php $linkData = get_field('link', $introData['post_id']); ?>
            <div class="over-div">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="over-div-inside">
                                <h2><?php echo $introData['post_title']; ?></h2>
                                <div class="text">
                                    <?php echo $introData['post_content']; ?>
                                </div>
                                <?php if( $linkData ): ?>
                                    <a href="<?php echo $linkData['url']; ?>" class="btn-link"><?php echo $linkData['title']; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <!-- end:home-intro -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>