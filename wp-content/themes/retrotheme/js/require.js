jQuery(document).ready(function () {

    // Set up menu
    setUpMenu();

    // Set up tabs dropdown
    // setUpTabsDropdown();

    // Set up filter dropdown
    setUpFilterDropdown();

    jQuery('#course-form input').click(function () {
        jQuery('#course-form input#spcheido').val(31);
    });

    const myCarouselElement = document.querySelector('#carouselBanner')

    if(myCarouselElement){
        const carousel = new bootstrap.Carousel(myCarouselElement, {
            interval: 8000,
        })
    }

});

/*
* Set up on scroll sticky menu
*
* @param ev
*/
window.onscroll = function (ev) {
    // Set up sticky menu
    setUpStickyMenu();
};

function setUpStickyMenu(){
    const headerDIV = document.querySelector(".header");
    const calScreenWidth = jQuery(window).width();

    if( window.scrollY >= 243 && calScreenWidth > 1024 ){
        headerDIV.classList.add('sticky');
    }
    else if( window.scrollY >= 120 && calScreenWidth <= 1024 ){
        headerDIV.classList.add('sticky');
    }
    else{
        headerDIV.classList.remove('sticky');
    }
}

function setUpTabsDropdown(){
    const calScreenWidth = jQuery(window).width();

    if( calScreenWidth <= 600 ){
        // Select the UL element that contains the tabs
        const tabs = jQuery("ul.tabs");

        // Loop through the tabs and create a dropdown menu for each one
        tabs.find("li").each(function() {
            var tab = jQuery(this);

            // Create the dropdown menu
            var dropdown = jQuery("<div class='dropdown'></div>");

            // Add the tab's label to the dropdown menu
            var label = jQuery("<span class='label'></span>");
            label.text(tab.text());
            dropdown.append(label);

            // Add the dropdown menu to the tab
            tab.append(dropdown);

            // Add an event listener to the dropdown menu
            dropdown.click(function() {
                // Get the tab's content
                var content = tab.next();

                // Toggle the visibility of the content
                content.toggle();
            });
        });
    }
}

function expandFilter(filterElement) {
    filterElement.classList.add("expanded");
}

function closeFilter(filterElement) {
    filterElement.classList.remove("expanded");
}


/**
 * Set up menu
 */
function setUpMenu() {

    var calScreenWidth = jQuery(window).width();

    if (calScreenWidth > 1024) {

        jQuery('.header .navbar .dropdown-toggle').unbind('click').click(function (e) {
            var location = jQuery(this).attr('href');
            window.location.href = location;
        });

        // Dropdown menu show on hover
        jQuery('.header .navbar-nav li.dropdown').hover(function () {
            jQuery(this).children('.dropdown-menu:first').show();
            jQuery(this).children('.dropdown-menu:first').addClass('show');
            jQuery(".search-suggestion").hide();
            jQuery(':focus').blur();
        }, function () {
            jQuery(this).find('.dropdown-menu').hide();
            jQuery(this).find('.dropdown-menu').removeClass('show');
        });

    } else {
        jQuery('.header-bottom .navbar .dropdown-toggle').unbind('click').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            if (jQuery(this).parent().children('.dropdown-menu:first').hasClass('show')) {
                jQuery(this).parent().children('.dropdown-menu:first').removeClass('show');
            } else {
                jQuery('.header-bottom .navbar .dropdown-menu').removeClass('show');
                const currentMenu = jQuery(this).parent().children('.dropdown-menu:first').addClass('show');
                jQuery("#navbarSupportedContent").scrollTop(jQuery(this).parent().prev().position().top);
            }
        });

        jQuery('.header-bottom .navbar .dropdown-toggle').unbind('dblclick').dblclick(function (e) {
            var location = jQuery(this).attr('href');
            window.location.href = location;
        });
    }

}

/**
 * Check if email valid
 *
 * @param string emailAddress
 *
 * @returns {boolean}
 */
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);

    return pattern.test(emailAddress);
}

/**
 * Reset form elements values
 */
function _resetFormElementsValues() {

    jQuery('input,textarea').not('input[type=submit]').not('#action').not('#contact-nonce').val('');
    jQuery('input:checkbox').removeAttr('checked');

    return false;

}

/**
 * Remove errors from form elements
 */
function _removeErrorsClass() {

    jQuery('input,textarea,label').removeClass('error-element');
    jQuery('*').removeClass('error-element');

    return false;

}

/**
 * Send message via ajax - contact form
 */
function sendContactMessage() {

    _removeErrorsClass();

    jQuery('#contact-form .contact-alert-warning').hide();

    const name = jQuery('#contact-name').val();
    const email = jQuery('#contact-email').val();
    const subject = jQuery('#contact-subject').val();
    const message = jQuery('#contact-message').val();
    const accept = jQuery('#contact-accept').is(':checked');
    const nonce = jQuery('#contact-nonce').val();

    let error = false;

    if (jQuery.trim(name) == '') {
        jQuery('input#contact-name').addClass('error-element');
        error = true;
    }
    if (jQuery.trim(subject) == '') {
        jQuery('input#contact-subject').addClass('error-element');
        error = true;
    }
    if (jQuery.trim(email) == '') {
        jQuery('input#contact-email').addClass('error-element');
        error = true;
    }
    if (!isValidEmailAddress(email)) {
        jQuery('input#contact-email').addClass('error-element');
        error = true;
    }
    if (jQuery.trim(message) == '') {
        jQuery('textarea#contact-message').addClass('error-element');
        error = true;
    }
    if (!accept) {
        jQuery('#contact-accept').parent().addClass('error-element');
        error = true;
    }
    if (jQuery.trim(nonce) == '') {
        error = true;
    }

    if (!error) {
        jQuery.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",
            data: 'action=contact_form&' + jQuery("#contact-form").serialize(),
            success: function (data) {
                var response_data = jQuery.parseJSON(data.substring(0, data.length - 1));

                if (response_data.status == 1) {

                    jQuery('#contact-form .contact-alert-warning').slideUp();
                    jQuery('#contact-form .contact-alert-success').slideDown();
                    _resetFormElementsValues();
                } else {
                    jQuery('#contact-form .contact-alert-warning').slideDown();
                }
            },
            error: function () {
                jQuery('#contact-form .contact-alert-warning').slideDown();
            },
            complete: function () {

            }
        });
    } else {
        jQuery('#contact-form .contact-alert-warning').slideDown();
    }

    return false;
}

function resetFilterCheckboxes() {

    const allCheckboxes = document.querySelectorAll('.filter-checkbox');

    Array.from(allCheckboxes).forEach((item) => {
        item.checked = false;
    });

    changeFilteredPostList();

    return false;
}

function getCategoriesTypes(selector) {

    const allCheckboxes = document.querySelectorAll('.' + selector);

    const selectedItems = Array.from(allCheckboxes).map((item) => {
        if (item.checked) {
            return item.value;
        }
        return false
    }).filter((item) => {
        return item !== false
    });

    if (selectedItems.length > 0) {
        const brandsValues = selectedItems.join('##');

        return '&' + selector + '=' + brandsValues;
    }

    return '';
}

/**
 * Change filtered post list
 */
function changeFilteredPostList() {

    // Get current post id
    const postID = document.getElementById('postListID') ? document.getElementById('postListID').value : 0;

    if (postID >= 0) {

        jQuery('.filter-list-over').show();

        // Prepare selected categories
        const topics = getCategoriesTypes("topic-check");
        const islands = getCategoriesTypes("island-check");
        const regions = getCategoriesTypes("region-check");

        jQuery.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",
            data:
                'action=filter_posts_list&' + jQuery("#filter-form").serialize() + topics + islands + regions,
            success: function (data) {
                var response_data = jQuery.parseJSON(data.substring(0, data.length - 1));

                if (response_data.status == 1) {
                    if (document.querySelector('.posts-list')) {
                        document.querySelector('.posts-list').innerHTML = response_data.html;
                    }
                    if (response_data.html_pagination.trim() !== '' && document.querySelector('#pagination-over')) {
                        document.querySelector('#pagination-over').innerHTML = response_data.html_pagination;
                        jQuery('#pagination-over').show();
                    }
                    if (document.querySelector('.posts-list h2')) {
                        jQuery('#pagination-over').hide();
                    }

                    window.history.pushState({}, "", response_data.filter_url);

                    jQuery('.filter-inner').removeClass('expanded');

                    jQuery("html, body").animate({ scrollTop: 0 }, "slow");
                }

                jQuery('.filter-list-over').hide();
            },
            error: function () {
                jQuery('.filter-list-over').hide();
            },
            complete: function () {
                jQuery('.filter-list-over').hide();
            }
        });
    }
}

function setUpFilterDropdown(){
    const calScreenWidth = jQuery(window).width();

    if( calScreenWidth <= 991 ){
        jQuery(".filter-button").click(function() {
            const divElement = document.querySelector(".filter-inner");
            if (divElement.classList.contains("expanded")) {
                divElement.classList.remove("expanded");
            } else {
                divElement.classList.add("expanded");
            }
        });
    }

    jQuery(".content-filter .filter .box-filter.expand h4").click(function() {
        const divElement = jQuery(this).parent(".box-filter");
        if (divElement.hasClass("expanded")) {
            divElement.removeClass("expanded");
        } else {
            divElement.addClass("expanded");
        }
    });
}