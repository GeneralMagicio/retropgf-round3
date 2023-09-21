<!-- start:content -->
<div class="content category-list mt-5 mb-5">

    <!-- start:intro-title -->
    <div class="intro-title">
        <!-- start:container -->
        <div class="container">
            <h1><?php echo $title; ?></h1>
        </div>
        <!-- end:container -->
    </div>
    <!-- end:intro-title -->

    <!-- start:content-inside -->
    <div class="content-inside">

        <!-- start:container -->
        <div class="container">

            <!-- start:category-list-inside -->
            <div class="category-list-inside">

                <!-- start:row -->
                <div class="row g-4 justify-content-center">

                    <?php if (have_posts()) : ?>

                        <?php $queryCounter = 1; ?>

                        <?php while (have_posts()) : the_post(); ?>

                            <?php

                            //prepare data
                            $postID = get_the_ID();
                            $thumbID = get_post_thumbnail_id();

                            $permalink = esc_url(get_the_permalink());

                            $image = wp_get_attachment_image_src($thumbID, 'full');
                            $imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);

                            ?>

                            <div class="col-12 col-md-8">
                                <div class="inside">
                                    <div class="row">
                                        <?php if (isset($image[0])): ?>
                                            <div class="col-12 col-md-6">
                                                <a href="<?php echo $permalink; ?>" class="image-holder">
                                                    <img src="<?php echo $image[0]; ?>"
                                                         alt="<?php echo $imageAlt; ?>"
                                                         class="img-responsive">
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12 col-md-6">
                                            <div class="category-item-right">
                                                <div class="text">
                                                    <h2>
                                                        <a href="<?php echo $permalink; ?>"><?php the_title(); ?></a>
                                                    </h2>
                                                    <?php the_excerpt(); ?>
                                                </div>
                                                <div>
                                                    <a href="<?php echo $permalink; ?>" class="more">+ find out more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php $queryCounter++; ?>

                        <?php endwhile; ?>

                    <?php endif; ?>

                </div>

                <div class="col-12">

                    <!-- start:post-pagination -->
                    <div class="post-pagination text-center">

                        <?php

                        the_posts_pagination(
                            array(
                                'mid_size' => 2,
                                'prev_text' => __('<', 'template'),
                                'next_text' => __('>', 'template'),
                            )
                        );

                        ?>

                    </div>
                    <!-- end:post-pagination -->

                </div>
                <!-- end:row -->

            </div>
            <!-- end:category-list-inside -->

        </div>
        <!-- end:container -->

    </div>
    <!-- end:content-inside -->

</div>
<!-- end:content -->