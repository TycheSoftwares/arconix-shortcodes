jQuery(document).ready( function(){

    /* Toggle functions -> */
    //Hide (Collapse) the toggle containers on load
    jQuery(".arconix-toggle-content").hide();

    //Switch the "Open" and "Close" state per click
    jQuery(".arconix-toggle-title").toggle(function(){
        jQuery(this).addClass("active");
        }, function () {
        jQuery(this).removeClass("active");
    });
    //Slide up and down on click
    jQuery(".arconix-toggle-title").click(function(){
        jQuery(this).next(".arconix-toggle-content").slideToggle();
    });

    //Tabs
    jQuery("ul.arconix-tabs").tabs("div.arconix-panes > div");

    //Accordion
    jQuery(".arconix-accordions-0").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: null });
    jQuery(".arconix-accordions-1").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 0 });
    jQuery(".arconix-accordions-2").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 1 });
    jQuery(".arconix-accordions-3").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 2 });
    jQuery(".arconix-accordions-4").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 3 });
    jQuery(".arconix-accordions-5").tabs("div.arconix-accordion-content", {tabs: 'div.arconix-accordion-title', effect: 'slide', initialIndex: 4 });
});