<!-- start:content -->
<div class="content category-list category-projects mt-5 mb-5">

    <!-- start:intro-title -->
    <div class="intro-title">
        <!-- start:container -->
        <div class="container">
            <h1>Projects: <?php echo $title; ?></h1>
        </div>
        <!-- end:container -->
    </div>
    <!-- end:intro-title -->

    <!-- start:content-inside -->
    <div class="content-inside">

        <!-- start:container -->
        <div class="container">

            <!-- start:category-list-inside -->
            <div class="category-list-inside accordion project-list" id="tags">

                <?php
                // List subcategories
                $subcategories = get_categories(array(
                    'child_of' => 8,
                    'hide_empty' => true,
                ));
                ?>

                <?php if (!empty($subcategories)): ?>

                    <ul class="nav nav-pills">

                        <?php $counter = 1; ?>
                        <?php foreach ($subcategories as $subcategory): ?>
                            <?php $subcatID = $subcategory->term_id; ?>
                            <li class="nav-item">
                                <a
                                        data-bs-toggle="collapse"
                                        href="#tag<?php echo $subcatID; ?>"
                                        role="button"
                                        aria-expanded="<?php echo ($counter == 1) ? 'true' : 'false'; ?>"
                                        aria-controls="tag<?php echo $subcatID; ?>"
                                        data-bs-toggle="collapse"
                                        class="btn btn-primary">
                                    <?php echo $subcategory->name; ?>
                                </a>
                            </li>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Round
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo get_category_link(12) ?>">All Rounds</a></li>
                                    <?php if( $catID != 13 ): ?>
                                        <li><a class="dropdown-item" href="<?php echo get_category_link(13) ?>">Round 1</a></li>
                                    <?php endif; ?>
                                    <?php if( $catID != 14 ): ?>
                                        <li><a class="dropdown-item" href="<?php echo get_category_link(14) ?>">Round 2</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                <?php endif; ?>

                <?php $counter = 1; ?>
                <?php foreach ($subcategories as $subcategory): ?>
                    <?php $subcatID = $subcategory->term_id; ?>
                    <div
                            class="collapse multi-collapse <?php echo ($counter == 1) ? 'show' : ''; ?>"
                            id="tag<?php echo $subcatID; ?>"
                            data-bs-parent="#tags"
                    >
                        <?php
                        $queryArgsProject = array(
                            'post_type' => 'post',
                            'tax_query' => array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => $subcatID,
                                ),
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => $catID,
                                ),
                            ),
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                        );
                        $queryProject = new WP_Query($queryArgsProject);
                        ?>

                        <?php if ($queryProject->have_posts()): ?>

                            <div class="row g-0 g-md-4">

                                <?php while ($queryProject->have_posts()): ?>

                                    <?php
                                    // Prepare data
                                    $queryProject->the_post();
                                    $postID = get_the_ID();

                                    $thumbID = get_post_thumbnail_id();
                                    $image = wp_get_attachment_image_src($thumbID, 'full');
                                    $imageAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true);

                                    $project_short_description = get_field('project_short_description', $postID);
                                    $value_awarded = get_field('value_awarded', $postID);
                                    $link = get_field('link', $postID);
                                    $linkToProject = ( isset($link) )? esc_url($link) : '';
                                    $tagHtml = ( isset($link) )? 'a' : 'div';
                                    ?>

                                    <div class="col-12 col-sm-6 col-xl-3 mb-4 mb-md-0">
                                        <<?php echo $tagHtml; ?> href="<?php echo $linkToProject; ?>" title="<?php the_title(); ?>"
                                        class="project-link" target="_blank">
                                            <span class="project-link-top">
                                                <?php if (isset($image[0])): ?>
                                                    <span class="image"
                                                          style="background-image: url(<?php echo $image[0]; ?>);"></span>
                                                <?php endif; ?>
                                                <span class="value">
                                                    <h3><?php _e('Value awarded:'); ?></h3> <?php echo $value_awarded; ?>
                                                </span>
                                            </span>
                                            <span class="title"><?php the_title(); ?></span>
                                            <span class="text">
                                                <?php echo $project_short_description; ?>
                                            </span>
                                        </<?php echo $tagHtml; ?>>
                                    </div>

                                <?php endwhile; ?>

                            </div>

                        <?php endif; ?>

                        <?php wp_reset_postdata(); ?>
                    </div>

                    <?php $counter++; ?>
                <?php endforeach; ?>

            </div>
            <!-- end:category-list-inside -->

            <div class="back-holder">
                <button id="back-to-top"><?php _e('Back to top'); ?></button>
            </div>

        </div>
        <!-- end:container -->

    </div>
    <!-- end:content-inside -->

</div>
<!-- end:content -->