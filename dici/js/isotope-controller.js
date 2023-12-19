(function($) {
    'use strict';
    var GridViewController = function() {

        if (!window.theme_vars.theme_prefix.length) { return; }
        var shuffle_options = eval('window.' + window.theme_vars.theme_prefix + '_isotope_options');
        if ('object' !== typeof shuffle_options) { return; }

        var grid_container = shuffle_options.wrapper_id;
        var item_selector = shuffle_options.item_selector;
        var grid_sizer = shuffle_options.grid_sizer ? shuffle_options.grid_sizer : '.grid-sizer';
        if (( 'object' !== typeof $('#'+grid_container).imagesLoaded() ) || ( 'object' !== typeof $('#'+grid_container).isotope() )
        ) { return; }
        $('#'+grid_container).imagesLoaded().always(function(){
            $('#'+grid_container).isotope({
                itemSelector: item_selector,
                percentPosition: true,
                masonry: {
                    columnWidth: grid_sizer
                }
            });
        });
    };

    console.log($(window).gridViewController);

    $(window).gridViewController = new GridViewController();

})(jQuery);