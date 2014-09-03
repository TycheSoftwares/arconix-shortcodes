/*
ARCONIX SHORTCODES JS
--------------------------

PLEASE DO NOT make modifications to this file directly as it will be overwritten on update.
Instead, save a copy of this file to your theme directory. It will then be loaded in place
of the plugin's version and will maintain your changes on upgrade
*/
jQuery(document).ready( function(){
    
    /** Toggle */
    // Sets the state of the content area (and associated icon) based on the class
    jQuery('.arconix-toggle-title').each( function() {
        if( jQuery(this).hasClass('toggle-closed') ) {
            jQuery(this).next('.arconix-toggle-content').hide();
        }
        else if( jQuery(this).hasClass('toggle-open') ) {
            jQuery(this).next('i.fa').toggleClass('fa-plus-square fa-minus-square');
        }
        
        jQuery(this).click( function() {
            jQuery(this).toggleClass('toggle-open').toggleClass('toggle-closed');
            jQuery(this).find('i.fa').toggleClass('fa-plus-square fa-minus-square');
            jQuery(this).next('.arconix-toggle-content').slideToggle();
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