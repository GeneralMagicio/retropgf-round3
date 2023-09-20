<?php

get_header();

    global $globalCategories;

    $postID = get_the_ID();

    if (has_category($globalCategories['topicID'], $postID)) {
        include 'templates/single/single-news.php';
    } else {
        include 'templates/single/single-main.php';
    }

get_footer();