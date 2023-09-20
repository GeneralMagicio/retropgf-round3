<!-- start:home-intro -->
<div class="home-intro course-intro">

    <!-- start:container -->
    <div class="container-fluid">

        <!-- start:row -->
        <div class="row align-items-center g-0">

            <div class="col-12 col-lg-9 col-xl-6 ms-auto">

                <div id="carouserIntro" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        // Prepare data
                        $postID = get_the_ID();

                        $thumbID = get_post_thumbnail_id();
                        $image = wp_get_attachment_image_src($thumbID, 'theme-thumb-1');
                        $imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);
                        ?>

                        <div class="carousel-item active">
                            <?php if (isset($image[0])): ?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo $imageAlt; ?>"
                                     class="img-responsive">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- end:row -->

    </div>
    <!-- end:container -->

    <?php
    // Prepare data
    $intro_text = get_field('intro_text', $postID);
    ?>

    <div class="over-div">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="over-div-inside">
                        <h1 class="mb-5"><?php the_title(); ?></h1>
                        <div class="text">
                            <?php echo $intro_text; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end:home-intro -->