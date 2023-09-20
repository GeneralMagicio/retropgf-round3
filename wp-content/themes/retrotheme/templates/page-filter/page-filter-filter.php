<?php
// Prepare data
$topicsChecks = (isset($_GET['topic-check'])) ? filter_var($_GET['topic-check']) : '';
$topicsCheck = explode('##', $topicsChecks);
$topicsIDs = (is_array($topicsCheck) && $topicsCheck[0] != '') ? $topicsCheck : [];

$islandsChecks = (isset($_GET['island-check'])) ? filter_var($_GET['island-check']) : '';
$islandsCheck = explode('##', $islandsChecks);
$islandsIDs = (is_array($islandsCheck) && $islandsCheck[0] != '') ? $islandsCheck : [];

$regionsChecks = (isset($_GET['region-check'])) ? filter_var($_GET['region-check']) : '';
$regionsCheck = explode('##', $regionsChecks);
$regionsIDs = (is_array($regionsCheck) && $regionsCheck[0] != '') ? $regionsCheck : [];

$searchString = (isset($_GET['s'])) ? filter_var($_GET['s']) : '';

$tag_id = (isset($tag_id) && !empty($tag_id) && $tag_id > 0) ? filter_var($tag_id) : 0;

$project_category_id = (isset($projectCategoryID) && !empty($projectCategoryID) && $projectCategoryID > 0) ? filter_var($projectCategoryID) : 0;

$posts = getPostFiltered(10, $topicsIDs, $regionsIDs, $islandsIDs, $searchString, $tag_id, $project_category_id);
?>

<!-- start:filter -->
<div class="filter">

    <h3 class="filter-button"><span></span><?php _e('Filteri', 'template'); ?></h3>

    <div class="filter-inner">

        <?php include __DIR__ . '../../elements/search-form.php'; ?>

        <form id="filter-form" action="<?php echo get_permalink(); ?>" method="get">
            <input type="hidden" id="postListID" name="postListID"
                   value="<?php echo get_the_ID(); ?>" autocomplete="off">

            <?php if (!empty($searchString)): ?>
                <input type="hidden" id="s" name="s" value="<?php echo $searchString; ?>" autocomplete="off">
            <?php endif; ?>

            <?php if (isset($tag_id) && !empty($tag_id) && $tag_id > 0): ?>
                <input type="hidden" id="tag_id" name="tag_id" value="<?php echo $tag_id; ?>" autocomplete="off">
            <?php endif; ?>

            <?php if (isset($project_category_id) && !empty($project_category_id) && $project_category_id > 0): ?>
                <input type="hidden" id="project_category_id" name="project_category_id" value="<?php echo $project_category_id; ?>" autocomplete="off">
            <?php endif; ?>

            <?php if (sizeof($topics)): ?>
                <div class="box-filter expand">
                    <h4><?php _e('Teme', 'template'); ?><span></span></h4>
                    <div class="checkboxes">
                        <?php foreach ($topics as $topic): ?>
                            <?php
                            $checked = (isset($topicsCheck) && is_array($topicsCheck) > 0 && in_array($topic->term_id, $topicsCheck)) ? 'checked' : '';
                            ?>
                            <label class="container-checkbox"><?php echo $topic->name; ?>
                                <input id="topic-<?php echo $topic->term_id; ?>"
                                       name="topic-<?php echo $topic->term_id; ?>" type="checkbox"
                                       value="<?php echo $topic->term_id; ?>" onchange="changeFilteredPostList();"
                                       class="topic-check filter-checkbox" autocomplete="off" <?php echo $checked; ?>>
                                <span class="checkmark"></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (sizeof($islands)): ?>
                <div class="box-filter box-filter-island expand">
                    <h4><?php _e('Otoci', 'template'); ?><span></span></h4>
                    <div class="checkboxes">
                        <?php foreach ($islands as $island): ?>
                            <?php
                            $checked = (isset($islandsCheck) && is_array($islandsCheck) > 0 && in_array($island->term_id, $islandsCheck)) ? 'checked' : '';
                            ?>
                            <label class="container-checkbox"><?php echo $island->name; ?>
                                <input id="island-<?php echo $island->term_id; ?>"
                                       name="island-<?php echo $island->term_id; ?>" type="checkbox"
                                       value="<?php echo $island->term_id; ?>" onchange="changeFilteredPostList();"
                                       class="island-check filter-checkbox" autocomplete="off" <?php echo $checked; ?>>
                                <span class="checkmark"></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php if (sizeof($regions)): ?>
                <div class="box-filter expand">
                    <h4><?php _e('Županija', 'template'); ?><span></span></h4>
                    <div class="checkboxes">
                        <?php foreach ($regions as $region): ?>
                            <?php
                            $checked = (isset($regionsCheck) && is_array($regionsCheck) > 0 && in_array($region->term_id, $regionsCheck)) ? 'checked' : '';
                            ?>
                            <label class="container-checkbox"><?php echo $region->name; ?>
                                <input id="region-<?php echo $region->term_id; ?>"
                                       name="region-<?php echo $region->term_id; ?>" type="checkbox"
                                       value="<?php echo $region->term_id; ?>" onchange="changeFilteredPostList();"
                                       class="region-check filter-checkbox" autocomplete="off" <?php echo $checked; ?>>
                                <span class="checkmark"></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div>
                <button type="button" class="btn btn-reset"
                        onclick="resetFilterCheckboxes();"><?php _e('Poništi sve', 'template'); ?></button>
            </div>

        </form>

    </div>


</div>
<!-- end:filter -->