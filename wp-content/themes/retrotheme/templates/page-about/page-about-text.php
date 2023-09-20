<!-- start:course-about -->
<div class="course-about content about-page">

    <!-- start:container -->
    <div class="container">

        <div class="row g-0 g-lg-5">

            <div class="col-12 col-lg-8">
                <div class="text">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                
                <div class="price mb-4">
                    <h4><?php _e('Katedra lokacije:', 'template'); ?></h4>
                    <div class="text-center"><?php echo get_field('locations', get_the_ID()); ?></div>
                </div>

                <div class="price mb-4">

                    <h4><?php _e('Kod nas možete naučiti:', 'template'); ?></h4>

                    <!-- start:home-our-menu -->
                    <div class="home-our-menu">

                        <?php
                        $learnMenuArguments = array(
                            'theme_location' => 'can_learn',
                            'menu' => '',
                            'container' => false,
                            'container_class' => null,
                            'container_id' => null,
                            'menu_class' => 'navbar-nav',
                            'menu_id' => '',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                            'before' => '',
                            'after' => '',
                            'link_before' => '',
                            'link_after' => '',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 4,
                        );

                        wp_nav_menu($learnMenuArguments);
                        ?>

                    </div>
                    <!-- end:home-our-menu -->
                </div>

                <?php $degrees_link = get_field('degrees_link', $postID); ?>

                <?php if (isset($degrees_link['url'])): ?>

                    <div class="price link">
                        <a href="<?php echo $degrees_link['url']; ?>">
                            <span class="title"><?php echo $degrees_link['title']; ?></span>
                            <span class="image-holder">
                                <span></span>
                            </span>
                        </a>
                    </div>

                <?php endif; ?>
            </div>

        </div>

    </div>
    <!-- end:container -->

</div>
<!-- end:course-about -->