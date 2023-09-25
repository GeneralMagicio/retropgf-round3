jQuery(document).ready(function () {

    // Set up menu
    setUpMenu();

});


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