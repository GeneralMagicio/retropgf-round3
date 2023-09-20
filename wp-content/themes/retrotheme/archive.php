<?php get_header(); ?>

<?php
$category   =   single_term_title("", false);
$catID      =   get_cat_ID( $category );
$title      =   ucfirst( $category );
$desc       =   category_description( $catID );

?>

<?php include 'templates/page-filter/page-filter.php'; ?>

<?php get_footer(); ?>