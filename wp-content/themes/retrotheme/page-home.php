<?php
/**
 * Template Name: Homepage
 */
?>
<?php get_header(); ?>

    <div class="home-page d-flex flex-column vh-100 justify-content-center align-items-center">
        <div class="mb-5">
            <img src="<?php echo TEMPLATEDIR; ?>/images/temp/logo.svg" alt="">
        </div>
        <h1 class="mb-5">
            <span>Shaping<span></span>tomorrow</span>
            <span>by rewarding<span></span>yesterday</span>
        </h1>
        <div class="soon">
            We are relaunching, come back soon ;)
        </div>
        <a href="https://twitter.com/retropgf" target="_blank" title="RetroPGF Community">Follow us on twitter -></a>
    </div>

<!--    --><?php //get_template_part('templates/page-home/page-home-about', 'intro'); ?>
<!---->
<!--    --><?php //get_template_part('templates/page-home/page-home-founded', 'intro'); ?>
<!---->
<!--    --><?php //get_template_part('templates/page-home/page-home-projects', 'intro'); ?>
<!---->
<!--    --><?php //get_template_part('templates/page-home/page-home-footer-image', 'intro'); ?>

<?php get_footer(); ?>