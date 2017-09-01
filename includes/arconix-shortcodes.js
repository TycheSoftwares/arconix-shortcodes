/*
ARCONIX SHORTCODES JS
--------------------------

PLEASE DO NOT make modifications to this file directly as it will be overwritten on update.
Instead, save a copy of this file to your theme directory. It will then be loaded in place
of the plugin's version and will maintain your changes on upgrade
*/
jQuery(document).ready( function(){

    /** Toggle */
    jQuery('.arconix-toggle-title').each( function() {
        /**
         * Set the state of the toggle based on the class.
         * This allows the user to dictate whether the toggle
         * is loaded opened or closed
         */
        if( jQuery(this).hasClass('toggle-closed') ) {
            jQuery(this).next('.arconix-toggle-content').hide();
        }
        else if( jQuery(this).hasClass('toggle-open') ) {
            jQuery(this).next('i.fa').toggleClass('fa-plus-square fa-minus-square');
        }

        // Change the state of the toggle on click
        jQuery(this).click( function() {
            jQuery(this).toggleClass('toggle-open toggle-closed');
            jQuery(this).find('i.fa').toggleClass('fa-plus-square fa-minus-square');
            jQuery(this).next('.arconix-toggle-content').slideToggle();
        });
    });
    
    jQuery('.arconix-accordion-title').click(function( e ) {
        if(jQuery('.arconix-accordion-title').hasClass('current')){
            if( jQuery(this).hasClass('current') ) {

                jQuery(this).next('.arconix-accordion-content').slideToggle();
                jQuery(this).removeClass('current');
                e.preventDefault();
            }
        } else {
            if( jQuery(this).hasClass('current') ) {

            } else {

                if(jQuery('.arconix-accordion-content').is(':visible')){
                    jQuery(this).next('.arconix-accordion-content').slideToggle();
                }else{
                    if( jQuery(this).hasClass('current') ) {
                        jQuery(this).next('.arconix-accordion-content').slideToggle();
                    } else {
                        jQuery(this).addClass('current');
                        jQuery(this).next('.arconix-accordion-content').slideToggle();
                        e.preventDefault();
                    }
                }
                
            }
        }
    })
    
    /** Unordered List */
    // Adds the ul class to the 'ul' element
    jQuery('.arconix-list ul').addClass('fa-ul');

    jQuery('.arconix-list').each( function() {
        // Extract the icon and color to be added to the 'i' element
        var icon = jQuery(this).data('arconix-icon');
        var color = jQuery(this).data('arconix-color');

        jQuery(this).find('li').prepend('<i class="fa fa-li ' + icon + ' ' + color + '"></i>');
    });

    /** Tabs */
    // Init the Tabs
    jQuery('ul.arconix-tabs').tabs('div.arconix-panes > div');
    
    // Loop through each tab title and add the icon if needed
    jQuery('ul.arconix-tabs li').each( function() {
        // Extract the icon and color to be added to the 'i' element
        var icon = jQuery(this).data('arconix-icon');
        var color = jQuery(this).data('arconix-color');
       
        if( icon.length > 2 ) { // Only add the icon if we have a string as the icon is optional
            jQuery(this).find('a').prepend('<i class="fa ' + icon + ' ' + color + '"></i>');  
        }
    });

    // Accordions
    jQuery('.arconix-accordions-0').tabs('div.arconix-accordion-content', {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: null });
    jQuery('.arconix-accordions-1').tabs('div.arconix-accordion-content', {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 0 });
    jQuery('.arconix-accordions-2').tabs('div.arconix-accordion-content', {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 1 });
    jQuery('.arconix-accordions-3').tabs('div.arconix-accordion-content', {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 2 });
    jQuery('.arconix-accordions-4').tabs('div.arconix-accordion-content', {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 3 });
    jQuery('.arconix-accordions-5').tabs('div.arconix-accordion-content', {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 4 });

});