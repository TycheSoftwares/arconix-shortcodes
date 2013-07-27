/*
ARCONIX SHORTCODES JS
--------------------------

PLEASE DO NOT make modifications to this file directly as it will be overwritten on update.
Instead, save a copy of this file to your theme directory. It will then be loaded in place
of the plugin's version and will maintain your changes on upgrade
*/
jQuery(document).ready( function(){

    // Toggle
    jQuery('.arconix-toggle-content').each( function() {
        // This looks at the initial state of each content area, and hide content areas that are closed
        if( jQuery(this).hasClass('toggle-closed')) {
            jQuery(this).hide();
        }
    });

    jQuery('.arconix-toggle-title').each( function() {
        // This runs when a Toggle Title is clicked. It changes the CSS and then runs the animation
        jQuery(this).click(function() {
            var toggleContent = jQuery(this).next('.arconix-toggle-content');

            jQuery(this).toggleClass('toggle-open').toggleClass('toggle-closed');            
            toggleContent.toggleClass('toggle-open').toggleClass('toggle-closed');
            toggleContent.slideToggle();
        });
    });

    //Tabs
    jQuery("ul.arconix-tabs").tabs("div.arconix-panes > div");

    //Accordions
    jQuery(".arconix-accordions-0").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: null });
    jQuery(".arconix-accordions-1").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 0 });
    jQuery(".arconix-accordions-2").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 1 });
    jQuery(".arconix-accordions-3").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 2 });
    jQuery(".arconix-accordions-4").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 3 });
    jQuery(".arconix-accordions-5").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 4 });
});