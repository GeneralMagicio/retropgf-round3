<!-- start:posts-list -->
<div class="posts-list">
    <?php if (isset($posts['data']) && sizeof($posts['data']) > 0): ?>
        <?php foreach ($posts['data'] as $postData): ?>
            <?php
            // Prepare data
            $postID = $postData->postID;
            $postExcerpt = wp_trim_words(get_the_excerpt($postID), 15);
            $permalink = get_the_permalink($postID);
            $thumbnail = get_the_post_thumbnail_url($postID, 'full');
            $month = date("n", strtotime($postData->postDate));
            $monthName = $monthNames[$month];
            ?>
            <div class="post-content">
                <div class="row">
                    <?php if ($thumbnail): ?>
                        <div class="col-12 col-lg-4">
                            <a href="<?php echo $permalink; ?>" title="<?php echo $postData->postTitle; ?>"
                               class="image-holder" style="background-image: url('<?php echo $thumbnail; ?>')"></a>
                        </div>
                    <?php endif; ?>
                    <div class="col-12 col-lg-8">
                        <!-- start:post-content-right -->
                        <div class="post-content-right">
                            <h3><a href="<?php echo $permalink; ?>"
                                   title="<?php echo $postData->postTitle ?>"><?php echo $postData->postTitle; ?></a>
                            </h3>
                            <div class="meta">
                                <time><?php echo date("j", strtotime($postData->postDate)); ?> <?php echo strtolower($monthName); ?>
                                    , <?php echo date("Y", strtotime($postData->postDate)); ?>.
                                </time>
                                / Vrijeme čitanja: <?php echo timeOfRead($postData->postContent); ?>min
                            </div>
                            <div class="text">
                                <?php echo $postExcerpt; ?>
                            </div>
                            <a href="<?php echo $permalink; ?>" class="more"><?php _e('Pročitaj više'); ?></a>
                        </div>
                        <!-- end:post-content-right -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


    <?php endif; ?>
</div>
<!-- end:posts-list -->

<?php $numberOfPages = ceil($posts['count'] / 10); ?>
<div id="pagination-over">
    <?php include 'page-filter-pagination.php'; ?>
</div>