jQuery(document).ready(function($) {
    "use strict";

    var menuToggle = function(togglers){
        if ( togglers.length ) {

            $(togglers).each( function(){
                $(this).on('click', function(){

                    var container = $(this).parent();
                    if ( $(container).hasClass('expanded') ) {
                        var MelementToExpand = $(container).find('ul.children, ul.sub-menu');
                        $(MelementToExpand).removeAttr('style');
                        $(container).toggleClass('expanded');
                    } else {
                        $(container).toggleClass('expanded');
                        var elementToExpand = $(container).find('ul.children, ul.sub-menu');
                        var curElementToExpand = $(container).find('ul.children, ul.sub-menu');
                        var elementToExpandHeight = 0;
                        $(elementToExpand).each(function(){
                            elementToExpandHeight += $(this).get(0).scrollHeight;
                        });
                        $(curElementToExpand).attr('style', 'max-height:'+elementToExpandHeight+'px;');
                    }
                });
            } );
        }
    }

    var subMenuToggler = function(){
        var parent_items = $('.widget_nav_menu li[class*=has-children], .widget_product_categories li[class*=parent]');
        if (parent_items.length){
            $(parent_items).append('<span class="expand"></span>');
        }

        var togglers = $('.widget_nav_menu li[class*=has-children] > span.expand, .widget_product_categories li[class*=parent] > span.expand');

        menuToggle(togglers);

    };

    subMenuToggler();

    var mobileMainMenuController = function(mediaQuery){
        if (mediaQuery.matches) { // If media query matches
            var parent_items = $('#site-navigation > ul > li[class*=has-children]');
            if ( parent_items.length ) {
                $(parent_items).append('<span class="expand"></span>');
                var togglers = $('#site-navigation > ul > li[class*=has-children] > span.expand');
                menuToggle(togglers);
            }

        } else {
            var toggleItems = $('#site-navigation > ul > li[class*=has-children] > span.expand');
            toggleItems.parent().removeClass('expanded');
            toggleItems.find('ul.sub-menu').removeAttr('style');
            toggleItems.remove();
        }
    };

    var mediaQuery = window.matchMedia("(max-width: 740px)");
    mobileMainMenuController(mediaQuery); // Call listener function at run time
    mediaQuery.addListener(mobileMainMenuController); // Attach listener function on state changes

});
