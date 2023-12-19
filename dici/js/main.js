( function( $ ) {
    "use strict";

    function useSelect2(){
        var selects = $('' +
            '.woocommerce-ordering select,' +
            '.dropdown_product_cat,' +
            '.tinvwl-break-input-filed,' +
            '.widget_archive select,' +
            '.widget_categories select,' +
            '#secondary .widget select');
        if ( selects.length && ( typeof $(document).select2 == 'function' ) ) {
            $(selects).select2({
                minimumResultsForSearch: 40
            });
        }
    }

    useSelect2();

} )( jQuery );