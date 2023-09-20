<!-- start:content -->
<div class="content content-region">

    <!-- start:container -->
    <div class="container">

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
    <!-- end:container -->

</div>
<!-- end:content -->