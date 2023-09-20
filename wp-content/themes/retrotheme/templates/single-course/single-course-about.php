<!-- start:course-about -->
<div class="course-about">

    <!-- start:container -->
    <div class="container">

        <h2><?php _e('Više o tečaju:', 'template'); ?></h2>

        <div class="row g-0 g-lg-5">

            <div class="col-12 col-lg-8">
                <div class="text">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="price">
                    <h4><?php _e('Cijene tečaja:', 'template'); ?></h4>
                    <?php echo nl2br(get_field('price_text', get_the_ID())); ?>
                </div>
            </div>

        </div>

    </div>
    <!-- end:container -->

</div>
<!-- end:course-about -->