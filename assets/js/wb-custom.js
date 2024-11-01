jQuery(document).ready(function(){
     // Activate isotope in container
    jQuery(".wbportfolio_items").isotope({
        itemSelector: '.wbportfolio_single_items',
        layoutMode: 'fitRows',
    });
    // Add isotope click function
    jQuery('.wbportfolio_filters li a').click(function(){
        jQuery(".wbportfolio_filter li a").removeClass("active");
        jQuery(this).addClass("active");
        var selector = jQuery(this).attr('data-filter');
        jQuery(".wbportfolio_items").isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false,
            }
        });
        return false;
    });


});
