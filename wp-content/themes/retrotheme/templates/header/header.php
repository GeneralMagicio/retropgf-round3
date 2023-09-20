<!-- start:header-over -->
<div class="header-over">

    <div class="star"></div>

    <header class="header">

        <!-- start:container -->
        <div class="container">

            <!-- start:row -->
            <div class="row align-items-center">

                <div class="col-5 col-xl-3 order-0">
                    <a href="<?php echo WPML_HOME_URL; ?>" title="<?php bloginfo('name'); ?>" class="logo">
                        <img src="<?php echo TEMPLATEDIR; ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
                    </a>
                </div>

                <div class="col-5 col-xl-auto ms-auto">
                    <nav class="navbar navbar-expand-xl">

                        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <svg viewBox="0 0 100 80" width="20" height="20">
                                <rect width="100" height="10"></rect>
                                <rect y="30" width="100" height="10"></rect>
                                <rect y="60" width="100" height="10"></rect>
                            </svg>
                        </button>

                        <div class="navbar-collapse collapse" aria-expanded="false">

                            <?php
                            $headerMenuArguments = array(
                                'theme_location' => 'header',
                                'menu' => '',
                                'container' => false,
                                'container_class' => null,
                                'container_id' => null,
                                'menu_class' => 'navbar-nav ms-auto',
                                'menu_id' => '',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 4,
                                'walker' => new wp_bootstrap4_navwalker()
                            );

                            wp_nav_menu($headerMenuArguments);
                            ?>

                        </div>

                    </nav>
                </div>

            </div>
            <!-- end:row -->

        </div>
        <!-- end:container -->
    </header>

    <?php if( is_front_page() ): ?>

        <?php $introData = getSpecificPostDataByCategory('post', 4) ?>

        <?php if( $introData ): ?>

            <!-- start:header-bottom -->
            <div class="header-bottom">

                <!-- start:container -->
                <div class="container">

                    <div class="row g-5">

                        <div class="col-12 col-md-6">
                            <h1><?php echo $introData['post_title']; ?></h1>
                            <div class="text">
                                <?php echo $introData['post_content']; ?>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 intro-image">
                            <img src="<?php echo TEMPLATEDIR; ?>/images/intro-image.svg" alt="Intro Image">
                        </div>

                    </div>

                </div>
                <!-- end:container -->

            </div>
            <!-- end:header-bottom -->

        <?php endif; ?>

    <?php endif; ?>

</div>
<!-- end:header-over -->

<!-- start:header -->
<header class="header position-relative">



</header>
<!-- end:header -->