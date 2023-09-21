<!-- start:footer -->
<footer class="footer">

    <!-- start:container -->
    <div class="container">

        <!-- start:footer-inside -->
        <div class="footer-inside">

            <div class="row">

                <div class="col-12 col-lg-3 footer-first">
                    <?php include __DIR__ . '/../elements/socials.php' ?>
                </div>

                <div class="col-12 col-lg-6 footer-second">
                    <div class="menu">
                        <?php
                        $headerMenuArguments = array(
                            'theme_location' => 'header',
                            'menu' => '',
                            'container' => false,
                            'container_class' => null,
                            'container_id' => null,
                            'menu_class' => '',
                            'menu_id' => '',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                            'before' => '',
                            'after' => '',
                            'link_before' => '',
                            'link_after' => '',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 1,
                        );

                        wp_nav_menu($headerMenuArguments);
                        ?>
                    </div>
                </div>

                <div class="col-12 col-lg-3 footer-third">
                    <div class="text">
                        Magically crafted by <a href="https://generalmagic.io" target="_blank" title="General Magic"
                                                class="gm">General
                            Magic</a><br>
                        Copyright 2023. <a href="https://www.optimism.io/" target="_blank" title="Optimism">Optimism
                            Attestation</a>
                    </div>
                </div>

            </div>

        </div>
        <!-- end:footer-inside -->


    </div>
    <!-- end:container -->

</footer>
<!-- end:footer -->