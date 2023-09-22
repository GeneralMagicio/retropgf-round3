<!-- start:content -->
<div class="content content-region">

    <!-- start:container -->
    <div class="container">

        <!-- start:intro-title -->
        <div class="intro-title">
            <!-- start:container -->
            <div class="container">
                <?php if (has_category(8)): ?>
                    <h1>
                        <a href="<?php echo get_category_link(8); ?>">Projects</a> =>
                        <?php the_title(); ?>
                    </h1>
                <?php else: ?>
                    <h1><?php the_title(); ?></h1>
                <?php endif; ?>
            </div>
            <!-- end:container -->
        </div>
        <!-- end:intro-title -->

        <!-- start:row -->
        <div class="row g-4 justify-content-center">

            <div class="col-12 col-md-8">

                <?php if (have_posts()) : ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <?php

                        //prepare data
                        $postID = get_the_ID();

                        $thumbID = get_post_thumbnail_id();
                        $image = wp_get_attachment_image_src($thumbID, 'full');
                        $imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);

                        $value_awarded = get_field('value_awarded', $postID);
                        ?>

                        <?php if (has_category(8)): ?>

                            <div class="project-intro">
                                <div class="row">
                                    <div class="col-12 col-md-auto">
                                        <?php if (isset($image[0])): ?>
                                            <div class="img-holder"><img src="<?php echo $image[0]; ?>"/></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if( $value_awarded ): ?>
                                        <div class="col-12 col-md-auto">
                                            <div class="value">
                                                <h3><?php _e('Value awarded:'); ?></h3> <?php echo $value_awarded; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                        <!-- start:text -->
                        <div class="text">
                            <?php the_content(); ?>
                        </div>
                        <!-- end:text -->

                    <?php endwhile; ?>

                <?php endif; ?>

            </div>

        </div>
        <!-- end:row -->

    </div>
    <!-- end:container -->

</div>
<!-- end:content -->