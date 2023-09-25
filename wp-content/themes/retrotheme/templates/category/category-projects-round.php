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
                    'child_of' => $catID,
                    'hide_empty' => 0,
                ));

                //project-list

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
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => $subcatID,
                                )
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
                                    ?>

                                    <div class="col-12 col-sm-6 col-xl-3 mb-4 mb-md-0">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
                                           class="project-link">
                                            <span class="project-link-top">
                                                <?php if (isset($image[0])): ?>
                                                    <span class="image" style="background-image: url(<?php echo $image[0]; ?>);"></span>
                                                <?php endif; ?>
                                            </span>
                                                            <span class="title"><?php the_title(); ?></span>
                                                            <span class="text">
                                                <?php echo $project_short_description; ?>
                                            </span>
                                        </a>
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

        </div>
        <!-- end:container -->

    </div>
    <!-- end:content-inside -->

</div>
<!-- end:content -->