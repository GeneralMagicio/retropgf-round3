<?php
// Get values
$optionsBasics = get_option('wedevs_basics');
?>

<!-- start:header-top -->
<div class="header-top">

    <!-- start:container -->
    <div class="container">

        <!-- start:row -->
        <div class="row justify-content-between align-content-center">

            <!-- start:header-top-left -->
            <div class="header-top-left col-auto col-sm-auto align-self-center">
                <?php if (isset($optionsBasics['header_top_mobile']) && $optionsBasics['header_top_mobile'] != ''): ?>
                    <a href="tel:<?php echo $optionsBasics['header_top_mobile']; ?>"
                       class="tel mr-2"><?php echo $optionsBasics['header_top_mobile']; ?></a>
                <?php endif; ?>
                <?php if (isset($optionsBasics['header_top_email']) && $optionsBasics['header_top_email'] != ''): ?>
                    <a href="mailto:<?php echo $optionsBasics['header_top_email']; ?>"
                       class="mail"><?php echo $optionsBasics['header_top_email']; ?></a>
                <?php endif; ?>
            </div>
            <!-- end:header-top-left -->

            <!-- start:header-top-right -->
            <div class="header-top-right col-auto col-sm-auto align-self-center">
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                       class="d-inline-block btn btn-login"><?php _e('My account', 'template'); ?></a>
                <?php else: ?>
                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                       class="d-inline-block btn btn-login"><?php _e('Login / Registration', 'template'); ?></a>
                <?php endif; ?>

                <?php $languages = apply_filters('wpml_active_languages', NULL); ?>

                <?php if (sizeof($languages) > 0): ?>

                    <!-- start:header-languages -->
                    <ul class="header-languages list list-inline text-center w-auto d-inline-block m-0">

                        <?php $counter = 1; ?>
                        <li class="separator d-inline-block w-auto">|</li>
                        <?php foreach ($languages as $key => $lang): ?>

                            <li class="d-inline-block w-auto">
                                <a class="<?php echo ($lang['active'] == 1) ? 'active' : ''; ?> text-uppercase ml-1"
                                   href="<?php echo $lang['url']; ?>" title="<?php echo $lang['native_name']; ?>">
                                    <?php echo $lang['native_name']; ?>
                                </a>
                            </li>

                            <?php $counter++; ?>
                        <?php endforeach; ?>

                    </ul>
                    <!-- end:header-languages -->

                <?php endif; ?>

            </div>
            <!-- end:header-top-right -->

        </div>
        <!-- end:row -->

    </div>
    <!-- end:container -->

</div>
<!-- end:header-top -->