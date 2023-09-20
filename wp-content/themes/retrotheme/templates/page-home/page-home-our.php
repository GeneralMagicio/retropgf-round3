<!-- start:page-home-our -->
<div class="page-home-our">

    <?php

    $categoryID = 7;

    if (function_exists('wpml_object_id_filter')) {
        $categoryID = wpml_object_id_filter($categoryID, 'category', false);
    }

    $queryArgs = array(
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $categoryID,
            )
        ),
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 1,
        'post_status' => 'publish'
    );

    $query = new WP_Query($queryArgs);

    $introData = getSpecificPostDataByCategory('post', 6);
    ?>

    <?php if ($query->have_posts()): ?>

        <!-- start:container -->
        <div class="container">

            <!-- start:row -->
            <div class="row justify-content-center align-items-center g-4">
                <?php while ($query->have_posts()): ?>

                    <?php
                    // Prepare data
                    $query->the_post();
                    $postID = get_the_ID();

                    $first_title = get_field('first_title', $postID);
                    $first_link = get_field('first_link', $postID);
                    $second_title = get_field('second_title', $postID);
                    $second_link = get_field('second_link', $postID);
                    $third_title = get_field('third_title', $postID);
                    $third_link = get_field('third_link', $postID);
                    $fourth_title = get_field('fourth_title', $postID);
                    $fourth_link = get_field('fourth_link', $postID);
                    $fifth_title = get_field('fifth_title', $postID);
                    $fifth_link = get_field('fifth_link', $postID);
                    $sixth_title = get_field('sixth_title', $postID);
                    $sixth_text = get_field('sixth_text', $postID);
                    $seventh_title = get_field('seventh_title', $postID);
                    $seventh_link = get_field('seventh_link', $postID);
                    ?>

                    <div class="col-12">
                        <h2><?php the_title(); ?></h2>
                    </div>

                    <?php if ($first_link): ?>
                        <div class="col-12 col-sm-6 col-lg-4 item item-1">
                            <a href="<?php echo $first_link['url']; ?>">
                                <span class="image-holder">
                                    <span></span>
                                </span>
                                <span class="title"><?php echo $first_title; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($second_link): ?>
                        <div class="col-12 col-sm-6 col-lg-4 item item-2">
                            <a href="<?php echo $second_link['url']; ?>">
                                <span class="image-holder">
                                    <span></span>
                                </span>
                                <span class="title"><?php echo $second_title; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($third_link): ?>
                        <div class="col-12 col-sm-6 col-lg-4 item item-3">
                            <a href="<?php echo $third_link['url']; ?>">
                                <span class="image-holder">
                                    <span></span>
                                </span>
                                <span class="title"><?php echo $third_title; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($fourth_link): ?>
                        <div class="col-12 col-sm-6 col-lg-4 item item-4">
                            <a href="<?php echo $fourth_link['url']; ?>">
                                <span class="image-holder">
                                    <span></span>
                                </span>
                                <span class="title"><?php echo $fourth_title; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($fifth_link): ?>
                        <div class="col-12 col-sm-6 col-lg-4 item item-5">
                            <a href="<?php echo $fifth_link['url']; ?>">
                                <span class="image-holder">
                                    <span></span>
                                </span>
                                <span class="title"><?php echo $fifth_title; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($sixth_title): ?>
                        <div class="col-12 col-sm-6 col-lg-4 item item-6">
                            <div class="no-link">
                                <span class="image-holder">
                                    <span></span>
                                </span>
                                <span class="title"><?php echo $sixth_title; ?></span>
                                <div class="over">
                                    <?php echo nl2br($sixth_text); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>

                <?php if (has_nav_menu('can_learn')): ?>
                    <div class="col-12 col-lg-8">
                        <!-- start:home-our-menu -->
                        <div class="home-our-menu">

                            <h3><?php _e('Kod nas možete naučiti:', 'template'); ?></h3>

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

                <?php endif; ?>

                <?php if (isset($seventh_title) && isset($seventh_link)): ?>
                    <div class="col-12 col-lg-4 item item-7">
                        <a href="<?php echo $seventh_link['url']; ?>">
                            <span class="title"><?php echo $seventh_title; ?></span>
                            <span class="image-holder">
                                <span></span>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
            <!-- end:row -->

        </div>
        <!-- end:container -->

    <?php endif; ?>

</div>
<!-- end:page-home-our -->

<?php wp_reset_postdata(); ?>