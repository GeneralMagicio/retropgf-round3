<!-- start:content -->
<div class="content content-region">

    <!-- start:container -->
    <div class="container">

        <!-- start:intro-title -->
        <div class="intro-title">
            <!-- start:container -->
            <div class="container">
                <h1><?php the_title(); ?></h1>
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
                        ?>

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