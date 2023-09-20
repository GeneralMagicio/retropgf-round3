<?php

global $wp;
$currentUrl = home_url($wp->request);

$queryVariables = [];

$topic_check = (isset($_GET['topic-check'])) ? filter_var($_GET['topic-check']) : '';
$topic_check = (isset($_POST['topic-check'])) ? filter_var($_POST['topic-check']) : $topic_check;

if ($topic_check != '') {
    $queryVariables['topic-check'] = $topic_check;
}

$island_check = (isset($_GET['island-check'])) ? filter_var($_GET['island-check']) : '';
$island_check = (isset($_POST['island-check'])) ? filter_var($_POST['island-check']) : $island_check;

if ($island_check != '') {
    $queryVariables['island-check'] = $island_check;
}

$region_check = (isset($_GET['region-check'])) ? filter_var($_GET['region-check']) : '';
$region_check = (isset($_POST['region-check'])) ? filter_var($_POST['region-check']) : $region_check;

if ($region_check != '') {
    $queryVariables['region-check'] = $region_check;
}

$search_check = (isset($_GET['s'])) ? filter_var($_GET['s']) : '';
$search_check = (isset($_POST['s'])) ? filter_var($_POST['s']) : $search_check;

if ($search_check != '') {
    $queryVariables['s'] = $search_check;
}

$page = (isset($_GET['str'])) ? filter_var($_GET['str']) : 1;
$queryString = http_build_query($queryVariables, '', '&');
$queryString = (trim($queryString) != '') ? '&' . $queryString : '';

$end_size = 1;
$mid_size = 2;
$dots = FALSE;

$numberOfPages = (!isset($numberOfPages)) ? 1 : $numberOfPages;

?>
<?php getPagination($currentUrl, $queryString, $numberOfPages, $page, $mid_size, $end_size); ?>