<!-- start:single-course-form -->
<div class="single-course-form pb-5">

    <!-- start:container -->
    <div class="container">

        <!-- start:course-form-inside -->
        <div class="course-form-inside">

            <h2><?php _e('Prijave na tečaj:', 'template'); ?></h2>

            <form id="course-form" role="form" action="" class="form">

                <input type="hidden" id="course-nonce" name="course-nonce"
                       value="<?php echo wp_create_nonce('course_form_check'); ?>" autocomplete="off">


                <!-- start:row -->
                <div class="row">

                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="contact-name"><?php _e('Ime i prezime:', 'template'); ?></label>
                            <input type="hidden" id="spcheido" name="spcheido" value="27">
                            <input type="text" id="course-name" name="course-name"
                                   class="form-control" placeholder="<?php _e('Sanja Anić'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="course-day"><?php _e('Datum rođenja (D/M/G)', 'template'); ?></label>
                            <div class="row justify-content-center align-items-center">
                                <div class="col-4">
                                    <select name="course-day" id="course-day" class="selectpicker" autocomplete="off">
                                        <option value="" disabled selected>dan</option>
                                        <?php for ($j = 1; $j <= 31; $j++): ?>
                                            <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select name="course-month" id="course-month" class="selectpicker"
                                            autocomplete="off">
                                        <option value="" disabled selected>mjesec</option>
                                        <?php for ($j = 1; $j <= 12; $j++): ?>
                                            <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select name="course-year" id="course-year" class="selectpicker" autocomplete="off">
                                        <option value="" disabled selected>godina</option>
                                        <?php for ($j = 1945; $j <= date("Y"); $j++): ?>
                                            <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="course-telephone"><?php _e('Mobitel:', 'template'); ?></label>
                            <input type="text" id="course-telephone" name="course-telephone"
                                   class="form-control" placeholder="<?php _e('+385 98 555 555'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="course-email"><?php _e('Email:', 'template'); ?></label>
                            <input type="email" id="course-email" name="course-email"
                                   class="form-control" placeholder="<?php _e('email@email.com'); ?>">
                        </div>

                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <?php

                        $currentPostID = get_the_ID();

                        $categoryID = 12;

                        if (function_exists('wpml_object_id_filter')) {
                            $categoryID = wpml_object_id_filter($categoryID, 'category', false);
                        }

                        $queryArgsCourses = array(
                            'post_type' => 'post',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => $categoryID,
                                )
                            ),
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        );

                        $queryCourses = new WP_Query($queryArgsCourses);
                        $courseID = 0;
                        ?>

                        <?php if ($queryCourses->have_posts()): ?>

                            <div class="form-group course-group">
                                <label for="contact-course"><?php _e('Vrsta tečaja:', 'template'); ?></label>
                                <select name="course-course" id="course-course" class="selectpicker" autocomplete="off"
                                        onchange="getCourseLanguages(this.value);">
                                    <option value="" disabled selected>odaberite tečaj</option>
                                    <?php $queryCoursesCounter = 1; ?>
                                    <?php while ($queryCourses->have_posts()): ?>

                                        <?php
                                        // Prepare data
                                        $queryCourses->the_post();
                                        $postID = get_the_ID();

                                        $selected = $postID == $currentPostID ? 'selected="selected"' : '';
                                        ?>

                                        <option value="<?php echo $postID; ?>" <?php echo $selected; ?>><?php the_title(); ?></option>

                                        <?php $queryCoursesCounter++; ?>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                        <?php endif; ?>

                        <div class="form-group course-group">
                            <label for="course-lang"><?php _e('Odaberite jezik tečaja:', 'template'); ?></label>
                            <select name="course-lang" id="course-lang" class="selectpicker" autocomplete="off"
                                    onchange="getCourseLanguages(this.value);">
                            </select>
                        </div>

                        <div class="form-group course-group">
                            <label for="course-location"><?php _e('Željena lokacija:', 'template'); ?></label>
                            <select name="course-location" id="course-location" class="selectpicker" autocomplete="off">
                                <option value="" disabled selected>odaberite lokaciju</option>
                                <option value="Kaštel Stari">Kaštel Stari</option>
                                <option value="Split">Split</option>
                                <option value="Trogir">Trogir</option>
                            </select>
                        </div>

                        <div class="form-group submit-over">
                            <div class="row justify-content-between pt-4">
                                <div class="col-auto">
                                    <?php
                                    $postPrivacyID = 3;
                                    if (function_exists('wpml_object_id_filter')) {
                                        $postPrivacyID = wpml_object_id_filter($postPrivacyID, 'page', false);
                                    }
                                    ?>
                                    <label for="course-accept" class="privacy-label">
                                        <input type="checkbox" id="course-accept" name="course-accept"
                                               autocomplete="off">
                                        <?php _e('Prihvaćam', 'template'); ?>
                                        <a href="<?php echo esc_url(get_permalink(get_option('wp_page_for_privacy_policy'))); ?>"
                                           target="_blank"><?php _e('UVJETE KORIŠTENJA', 'template'); ?></a>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" id="course-submit" class="btn btn-submit text-uppercase"
                                            onclick="return sendCourseMessage();"><?php _e('POŠALJI UPIT', 'template'); ?></button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="alert alert-success course-alert-success rounded-0">
                            <strong><?php _e('Vašu upit je poslan!', 'template'); ?></strong>
                        </div>

                        <div class="alert alert-warning course-alert-warning rounded-0">
                            <strong><?php _e('Sva polja su obavezna.', 'template'); ?></strong>
                        </div>

                    </div>

                    <script>
                        getCourseLanguages(<?php echo $currentPostID; ?>);
                    </script>

                </div>
                <!-- end:row -->

            </form>

        </div>
        <!-- end:course-form-inside -->

    </div>
    <!-- end:container -->

</div>
<!-- end:single-course-form -->