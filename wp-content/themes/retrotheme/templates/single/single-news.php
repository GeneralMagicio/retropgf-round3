<?php

// Prepare data
$thumbID = get_post_thumbnail_id();
$image = wp_get_attachment_image_src($thumbID, 'full');
$imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);
$image_bg = isset($image[0]) ? $image[0] : '';

$authorID = get_post_field('post_author', get_the_ID());
$tags = get_the_tags();
?>
<!-- start:content -->
<div class="content content-region content-post">

    <div class="content-post-image" style="background-image: url('<?php echo $image_bg; ?>');"></div>

    <!-- start:container -->
    <div class="container">

        <!-- start:container-inside -->
        <div class="container-inside">

            <!-- start:content-post-intro -->
            <div class="content-post-intro">
                <h1><?php the_title(); ?></h1>
                <div class="meta">
                    Objavio: <a
                            href="<?php echo esc_url(get_author_posts_url($authorID)); ?>"
                            class="author"><?php echo get_the_author_meta('display_name', $authorID); ?></a>
                    - <?php echo get_the_date('d.m.Y.'); ?> - Vrijeme
                    čitanja: <?php echo timeOfRead(get_the_content()); ?>min
                </div>
            </div>
            <!-- end:content-post-intro -->

            <!-- start:row -->
            <div class="row">

                <div class="col-12 col-md-8">

                    <!-- start:content-post-left -->
                    <div class="content-post-left">

                        <?php if (have_posts()) : ?>

                            <?php while (have_posts()) : the_post(); ?>

                                <?php

                                //prepare data
                                $postID = get_the_ID();
                                $tag_list = get_the_tag_list('', ', ', '');
                                ?>

                                <!-- start:text -->
                                <div class="text">
                                    <?php the_content(); ?>
                                    <?php if (!empty($tags) && !is_wp_error($tags)): ?>
                                        <div class="tags">
                                            <span>Tagovi: </span> <?php echo $tag_list; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- end:text -->

                            <?php endwhile; ?>

                        <?php endif; ?>

                    </div>
                    <!-- end:content-post-left -->

                </div>

                <div class="col-12 col-md-4">

                    <!-- start:content-post-right -->
                    <div class="content-post-right">

                        <?php
                        global $globalCategories;

                        $queryArgsNews = array(
                            'post_type' => 'post',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => $globalCategories['topicID'],
                                )
                            ),
                            'post__not_in' => array($postID),
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => 4,
                            'post_status' => 'publish'
                        );

                        $queryNews = new WP_Query($queryArgsNews);
                        ?>
                        <?php if ($queryNews->have_posts()): ?>
                            <div class="box">
                                <h3><?php _e('Najnovije vijesti', 'template'); ?></h3>
                                <?php while ($queryNews->have_posts()): ?>
                                    <?php
                                    // Prepare data
                                    $queryNews->the_post();
                                    $thumbID = get_post_thumbnail_id();
                                    $image = wp_get_attachment_image_src($thumbID, 'medium');
                                    $bgImage = (isset($image[0])) ? $image[0] : '';
                                    ?>
                                    <a href="<?php the_permalink(); ?>"
                                       class="row justify-content-center align-items-center g-0">
                                        <span class="col-3 image-holder"
                                              style="background-image: url('<?php echo $bgImage; ?>')"></span>
                                        <span class="col-9 title"><?php the_title(); ?></span>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>

                        <?php
                        // Convert the list of tags into an array
                        $tags_array = explode(',', $tag_list);

                        // Create an array to store the tag slugs
                        $tag_slugs = array();

                        // Get the tag slugs from the provided tag names
                        foreach ($tags_array as $tag_name) {
                            $tag = get_term_by('name', trim($tag_name), 'post_tag');
                            if ($tag) {
                                $tag_slugs[] = $tag->slug;
                            }
                        }

                        $queryArgsRelated = array(
                            'post_type' => 'post',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => 7292,
                                )
                            ),
                            'tag_slug__in' => $tag_slugs,
                            'post__not_in' => array($postID),
                            'orderby' => 'rand',
                            'order' => 'DESC',
                            'posts_per_page' => 4,
                            'post_status' => 'publish'
                        );

                        $queryRelated = new WP_Query($queryArgsRelated);
                        ?>
                        <?php if ($queryRelated->have_posts()): ?>
                            <div class="box pt-4">
                                <h3><?php _e('Povezane vijesti', 'template'); ?></h3>
                                <?php while ($queryRelated->have_posts()): ?>
                                    <?php
                                    // Prepare data
                                    $queryRelated->the_post();
                                    $thumbID = get_post_thumbnail_id();
                                    $image = wp_get_attachment_image_src($thumbID, 'medium');
                                    $bgImage = (isset($image[0])) ? $image[0] : '';
                                    ?>
                                    <a href="<?php the_permalink(); ?>"
                                       class="row justify-content-center align-items-center g-0">
                                        <span class="col-3 image-holder"
                                              style="background-image: url('<?php echo $bgImage; ?>')"></span>
                                        <span class="col-9 title"><?php the_title(); ?></span>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>

                    </div>
                    <!-- end:content-post-right -->

                </div>

            </div>
            <!-- end:row -->

        </div>
        <!-- end:container-inside -->

    </div>
    <!-- end:container -->

</div>
<!-- end:content -->