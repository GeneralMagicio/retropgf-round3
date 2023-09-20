<!-- start:header-over -->
<div class="header-over">
    
</div>
<!-- end:header-over -->

<!-- start:header -->
<header class="header position-relative">

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

            <div class="col-12 d-block d-xl-none order-3">
                <div class="collapse navbar-collapse" id="navbarDefault" aria-expanded="false" style="">

                    <?php
                    $headerMenuArguments = array(
                        'theme_location' => 'header',
                        'menu' => '',
                        'container' => false,
                        'container_class' => null,
                        'container_id' => null,
                        'menu_class' => 'navbar-nav mr-auto',
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

                    <div class="row justify-content-center align-items-center pt-4">
                        <div class="col-12 col-md-auto">
                            <?php include __DIR__ . '../../elements/socials.php'; ?>
                        </div>
                        <div class="col-12 col-md-auto">
                            <?php include __DIR__ . '../../elements/search-form.php'; ?>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-12 col-lg-12 d-none d-xl-block">
                <div class="row justify-content-end align-items-center">
                    <div class="col-auto">
                        <?php include __DIR__ . '../../elements/socials.php'; ?>
                    </div>
                    <div class="col-auto">
                        <?php include __DIR__ . '../../elements/search-form.php'; ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- end:row -->

    </div>
    <!-- end:container -->

</header>
<!-- end:header -->