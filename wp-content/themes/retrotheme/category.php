<?php get_header(); ?>

<?php
$category   =   single_term_title("", false);
$catID      =   get_cat_ID( $category );
$title      =   ucfirst( $category );
$desc       =   category_description( $catID );

?>

<?php if( $catID == 12 ): ?>
    <?php include 'templates/category-course/category-course.php'; ?>
<?php else: ?>
    <?php include 'templates/category/category-main.php'; ?>
<?php endif; ?>

<?php get_footer(); ?>