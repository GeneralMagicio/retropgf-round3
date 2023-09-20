<!-- start:intro-bread -->
<div class="intro-bread">

    <!-- start:container -->
    <div class="container py-4">

        <a href="<?php echo get_home_url(); ?>" title="Naslovnica">Naslovnica</a>



            <?php if( get_the_title() ): ?>
                <span class="devider">&gt;</span><?php the_title(); ?>
            <?php endif; ?>

    </div>
    <!-- end:container -->

</div>
<!-- end:intro-bread -->