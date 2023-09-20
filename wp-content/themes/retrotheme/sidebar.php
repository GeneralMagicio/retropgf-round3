<aside>

    <!-- start:aside-box -->
    <div class="aside-box aside-news mb-4">
        <h3>Novosti</h3>
        <?php

        $categoryID = 7;

        if (function_exists('wpml_object_id_filter')) {
            $categoryID = wpml_object_id_filter($categoryID, 'category', false);
        }

        $category = get_category($categoryID);

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
            'posts_per_page' => 5,
            'post_status' => 'publish'
        );

        $query = new WP_Query($queryArgs);
        ?>

        <?php if ($query->have_posts()): ?>

            <?php while ($query->have_posts()): ?>

                <?php
                // Prepare data
                $query->the_post();
                ?>

                <a href="<?php echo get_the_permalink(); ?>">
                    <span class="time"><?php echo get_the_date("d.m.Y."); ?></span>
                    <span class="title"><?php the_title(); ?></span>
                </a>
                

            <?php endwhile; ?>

        <?php endif; ?>
    </div>
    <!-- end:aside-box -->

    <!-- start:aside-box -->
    <div class="aside-box aside-menu">
        <?php
        $sidebarMenuArguments = array(
            'theme_location' => 'sidebar',
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

        wp_nav_menu($sidebarMenuArguments);
        ?>
    </div>
    <!-- end:aside-box -->

</aside>