<?php
add_action('template_redirect','redirect_all_pages_to_home');

function redirect_all_pages_to_home() {
    if ( ! is_front_page() ) {
        wp_redirect( get_home_url() );
        exit;
    }
}

/**
 * Theme functions
 */
if (function_exists('current_user_can') && current_user_can('manage_options')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

/* Main global variables */
define('TEMPLATEDIR', get_template_directory_uri());

/* Enable post thumbnails */
add_theme_support('post-thumbnails');

/* Define WPML home url */
$wpml_home_url = apply_filters('wpml_home_url', get_option('home'));
define('WPML_HOME_URL', $wpml_home_url);

/* manage thumbs */
add_image_size('theme-thumb-1', 800, 600, TRUE);


/* enable scripts - jquery */
add_action('wp_enqueue_scripts', 'add_theme_js_scripts', 1);

function add_theme_js_scripts()
{
    wp_enqueue_script('jquery');
}


/* Image compression */
add_filter('jpeg_quality', function ($arg) {
    return 100;
});

add_filter('wp_editor_set_quality', function ($arg) {
    return 100;
});

function custom_jpeg_quality($quality, $context)
{
    return 100;
}

add_filter('jpeg_quality', 'custom_jpeg_quality', 10, 2);

// Disable image quality compression
function disable_image_compression()
{
    add_filter('jpeg_quality', function ($arg) {
        return 100;
    });
    add_filter('wp_editor_set_quality', function ($arg) {
        return 100;
    });
}

add_action('after_setup_theme', 'disable_image_compression');

function custom_jpeg_quality_crop($quality, $context)
{
    if ($context == 'image_resize' || $context == 'image_edit') {
        return 100;
    }
    return $quality;
}

add_filter('jpeg_quality', 'custom_jpeg_quality_crop', 10, 2);

/*-----------------------------------------------------------------------------------*/
/* Theme settings data
/*-----------------------------------------------------------------------------------*/

include('admin-theme/admin/settings-api.php');

/*-----------------------------------------------------------------------------------*/
/* Menus */
/*-----------------------------------------------------------------------------------*/

include('admin-theme/menu/menus.php');
include('admin-theme/menu/wp_bootstrap_navwalker.php');

/*-----------------------------------------------------------------------------------*/
/* Custom files
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Custom Content Types
/*-----------------------------------------------------------------------------------*/

/* Page & Post form */
include 'admin-theme/post-types/post-page-post-type.php';

/**
 * Get specific post data by selected gallery,
 * choose image thumbnail...
 *
 * @param string $postType
 * @param int $categoryId
 * @param string $imageThumb
 *
 * @return array
 */
function getSpecificPostDataByCategory($postType = 'post', $categoryId = 0, $imageThumb = 'full')
{

    $returnData = [];

    if (function_exists('wpml_object_id_filter') && $categoryId > 0) {
        $categoryId = wpml_object_id_filter($categoryId, 'category', false);
    }

    $queryArgs = array(
        'post_type' => $postType,
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 1,
    );

    if ($categoryId > 0) {
        $queryArgs['tax_query'] = [
            [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $categoryId,
                'include_children' => false,
            ]
        ];
    }

    $query = new WP_Query($queryArgs);

    if ($query->have_posts()) {

        while ($query->have_posts()) {
            $query->the_post();

            $postID = get_the_ID();

            $returnData['post_id'] = $postID;
            $returnData['post_title'] = get_the_title();
            $returnData['post_content'] = get_the_content();
            $returnData['post_excerpt'] = get_the_excerpt();
            $returnData['image'] = wp_get_attachment_image_src(get_post_thumbnail_id(), $imageThumb);
            $returnData['permalink'] = esc_url(get_permalink($postID));
            $returnData['icon'] = get_post_meta($postID, 'icon', TRUE);
        }

    }

    wp_reset_postdata();

    return $returnData;
}

function getPagination($currentUrl, $queryString, $numberOfPages, $page, $mid_size = 1, $end_size = 2, $dots = false, $print = true)
{

    $html = '<div id="pagination-div" class="pagination text-center">';

    if ($numberOfPages > 1 && $page > 1) {
        $html .= '<a class="prev page-numbers" href="' . $currentUrl . '?str=' . ($page - 1) . $queryString . '">«</a>';
    }

    for ($i = 1; $i <= $numberOfPages; $i++) {

        if ($i == $page) { /* Current page */
            $html .= '<span aria-current="page" class="page-numbers current">' . $page . '</span>';
            $dots = TRUE;
        } else {

            if ($i <= $end_size || ($page && $i >= $page - $mid_size && $i <= $page + $mid_size) || $i > $numberOfPages - $end_size) {
                $html .= '<a class="page-numbers" href="' . $currentUrl . '?str=' . $i . $queryString . '">' . $i . '</a>';
                $dots = TRUE;
            } elseif ($dots) {
                $html .= '<span class="page-numbers dots">…</span>';
                $dots = FALSE;
            }

        }

    }

    if ($page < $numberOfPages) {
        $html .= '<a class="next page-numbers" href="' . $currentUrl . '?str=' . ($page + 1) . $queryString . '" >»</a>';
    }

    $html .= '</div>';

    if ($print) {
        echo $html;
    } else {
        return $html;
    }

}

// Hooking up our functions to WordPress filters
add_filter('wp_mail_from', 'wpb_sender_email');
add_filter('wp_mail_from_name', 'wpb_sender_name');

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

function remove_excerpt_dots($excerpt)
{
    $new_excerpt = str_replace('...', '', $excerpt);
    return $new_excerpt;
}

add_filter('the_excerpt', 'remove_excerpt_dots');

function remove_excerpt_dots_second($more)
{
    return '';
}

add_filter('excerpt_more', 'remove_excerpt_dots_second');

/**
 * Number of minutes to read the content
 *
 * @param $content
 * @return float|int
 */
function timeOfRead($content)
{
    // Count the number of words
    $word_count = str_word_count(strip_tags($content));

    // Estimate the reading time (words per minute)
    $words_per_minute = 200;
    $reading_time = ceil($word_count / $words_per_minute);

    return $reading_time;
}

/**
 * Assign parent category for subcategory post
 *
 * @param $post_id
 * @return void
 */
function assign_parent_category_for_subcategory_post($post_id) {
    // Get the post object
    $post = get_post($post_id);

    // Check if the post is of 'post' type and has at least one category assigned
    if ($post->post_type === 'post' && has_term('', 'category', $post_id)) {
        // Get the categories assigned to the post
        $post_categories = wp_get_post_categories($post_id);

        // Loop through the categories to find the parent category
        foreach ($post_categories as $category_id) {
            $category = get_category($category_id);
            // Check if the category has a parent
            if ($category->parent !== 0) {
                // Assign the parent category to the post
                wp_set_post_categories($post_id, array($category->parent), true);
                break; // Stop after assigning the first parent category found
            }
        }
    }
}
add_action('save_post', 'assign_parent_category_for_subcategory_post');

/**
 * Disable showing author page in RSS and og meta tags
 */
add_filter( 'oembed_response_data', 'disable_embeds_filter_oembed_response_data_' );
function disable_embeds_filter_oembed_response_data_( $data ) {
    unset($data['author_url']);
    unset($data['author_name']);
    return $data;
}

function disable_author_page() {
    global $wp_query;

    // If an author page is requested, redirects to the home page
    if ( $wp_query->is_author ) {
        wp_safe_redirect( get_bloginfo( 'url' ), 301 );
        exit;
    }

}
add_action( 'wp', 'disable_author_page' );

