 (function ($) {
	"use strict"; 
jQuery(document).ready(function($){
    $(window).scroll(function(){
        if ($(window).scrollTop() >= 40) {
           $('.header-white').addClass('fixed-header');
        }
        else {
           $('.header-white').removeClass('fixed-header');
        }
    });
});

/* scrollTop() >= 240
   Should be equal the the height of the header
 */
 })(jQuery);