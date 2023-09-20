<!-- start:header-navigation -->
<header class="header-navigation position-relative mb-2">

    <!-- start:container -->
    <div class="container">

        <nav class="navbar navbar-expand-lg">

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i> Menu
            </button>

            <div class="navbar-collapse collapse" id="navbarsDefault" aria-expanded="false" style="">

                <?php
                $headerMenuArguments = array(
                    'theme_location'  => 	'header',
                    'menu'            => 	'',
                    'container'       => 	false,
                    'container_class' => 	null,
                    'container_id'    => 	null,
                    'menu_class'      => 	'navbar-nav mr-auto',
                    'menu_id'         => 	'',
                    'echo'            => 	true,
                    'fallback_cb'     => 	'wp_page_menu',
                    'before'          => 	'',
                    'after'           => 	'',
                    'link_before'     =>	'',
                    'link_after'      => 	'',
                    'items_wrap'      => 	'<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 	4,
                    'walker' 			=> 	new wp_bootstrap4_navwalker()
                );

                wp_nav_menu( $headerMenuArguments );
                ?>

            </div>

        </nav>

        <!-- start:main-search-form -->
        <div class="main-search-form position-relative w-100 display-mobile">
            <form id="search-form" action="<?php echo get_the_permalink(2090); ?>" class="form-inline w-100" method="get">
                <input type="hidden" id="search-nonce" name="search-nonce" value="<?php echo wp_create_nonce('search_check'); ?>" autocomplete="off">
                <div class="form-elements-holder clearfix w-100">
                    <input id="pojam-pretrage" name="pojam-pretrage" type="text" class="form-control" placeholder="<?php _e('Find a product', 'template'); ?>">
                    <button type="submit"><?php _e('Search', 'template'); ?></button>
                </div>
            </form>
            <div class="search-suggestion position-absolute d-none">

            </div>
        </div>
        <!-- end:main-search-form -->

    </div>
    <!-- end:container -->

</header>
<!-- end:header-navigation -->