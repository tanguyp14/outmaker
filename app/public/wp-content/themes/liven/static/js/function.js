// JavaScript Document
/* all function in this Js file
   	bxslider
	header
 */
 (function ($) {
	"use strict"; 
jQuery(document).ready(function($){
	//Blog Image perfectaion
	$('.blog').find('img').addClass('img-responsive');

	//parallax
	$('#parallax-2').parallax("50%",0);
    $('.liven_parallax').parallax("50%",0);
	$('#parallax-3').parallax("50%",0);
	
	$('.variable-width').slick({
	  centerMode: true,
	  dots: false,
	  slidesToShow: 1,
	  autoplay: true,
	  autoplaySpeed: 3000,
	  speed: 300,
	  variableWidth: true,
	  pauseOnHover: false,
	  responsive: [
		{
		  breakpoint: 1024,
		  settings: {
			centerMode: true,
			variableWidth: true,
			slidesToShow:1
		  }
		},
		{
		  breakpoint: 850,
		  settings: {
			centerMode: true,
			variableWidth: false,
			slidesToShow:1
		  }
		},
		{
		  breakpoint: 767,
		  settings: {
			arrows: false,
			slidesToShow:1,
			variableWidth: false,
			centerMode: true
		  }
		},
		{
		  breakpoint: 550,
		  settings: {
			arrows: false,
			slidesToShow:1,
			centerMode: false,
			variableWidth: false
		  }
		}
	  ]
	});
	
	
	
	$('.testimonialslider').slick({
	  dots: false,
	  infinite: true,
	  slidesToShow: 1,
	  autoplay: true,
	  autoplaySpeed: 3000,
	  pauseOnHover: true,
	  responsive: [
		{
		  breakpoint: 850,
		  settings: {
			arrows: false,
		  }
		},
		{
		  breakpoint: 550,
		  settings: {
			arrows: false,
			
		  }
		}
	  ]
	});
	
	$('.clientslider').slick({
	  dots: false,
	  infinite: true,
	  slidesToShow: 5,
	  autoplay: true,
	  autoplaySpeed: 3000,
	  arrows: false,
	  pauseOnHover: false,
	  responsive: [
		{
		  breakpoint: 1025,
		  settings: {
			arrows: false,
			slidesToShow:4
		  }
		},
		{
		  breakpoint: 850,
		  settings: {
			arrows: false,
			slidesToShow: 3
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		}
	  ]
	});
	
	$('.singleslider').slick({
	  dots: true,
	  infinite: true,
	  slidesToShow: 1,
	  autoplay: true,
	  autoplaySpeed: 3000,
	  arrows: true,
	  pauseOnHover: false,
	  responsive: [
		{
		  breakpoint: 768,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		}
	  ]
	});
	
	// Menu Script for web and mobile
	if ($(window).width() > 1024){	
				 $('.sub-menu li').mouseenter(function() {
			  
			 
			 if(!$(this).parent('.sub-menu').first().is_on_screen())
				$(this).find('.sub-menu').addClass("leftmenu"); 
				
			  $(this).find('.sub-menu').first().show(); 
			}).mouseleave(function() {      
					 $(this).find('.sub-menu').first().hide();
			});
		
		
		
		$.fn.is_on_screen = function(){
			var win = $(window);
			var viewport = {
				left : win.scrollLeft()
			};
			viewport.right = viewport.left + win.width()-360;
		 
			var bounds = this.offset();
			bounds.right = bounds.left + this.outerWidth();
		 
			return (!(viewport.right < bounds.left || viewport.left > bounds.right ));
		};
	}	
	else
	{
		$('.menu').css("max-height",$(window).height()-100);	
		
		$('.menu li.menu-item-has-children > a').on('click', function(e) {
			e.preventDefault();
			$(this).parent().toggleClass('child-open');
			$(this).siblings("ul").toggleClass('menu-is-visible');
			if(!$(this).parent().hasClass('child-open')){
				$(this).siblings("ul").find('ul').removeClass('menu-is-visible');
				$(this).siblings("ul").find('li').removeClass('child-open');
			//	alert($(this).parent().siblings("li").html());
				
			}
			else
			{
				$(this).parent('li').siblings("li").removeClass('child-open');
				$(this).parent('li').siblings("li").each(function( index ) {
  							$(this).find('ul').removeClass('menu-is-visible');
							$(this).find('li').removeClass('child-open');
				});
			}
   		 });
		 
	}
	
	// slider page function
	
	$('.fixslider').slick({
	  dots: true,
	  infinite: true,
	  slidesToShow: 1,
	  autoplay: true,
	  autoplaySpeed: 3000,
	  arrows: true,
	  pauseOnHover: false,
	  responsive: [
		{
		  breakpoint: 768,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		}
	  ]
	});
	
	// small images slider function
	$('.halfwidthleft').slick({
	  dots: true,
	  infinite: true,
	  slidesToShow: 1,
	  autoplay: true,
	  autoplaySpeed: 3000,
	  arrows: true,
	  pauseOnHover: false,
	  responsive: [
		{
		  breakpoint: 768,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		}
	  ]
	});
	
	// content slider
	$('.contentslider').slick({
	  dots: true,
	  infinite: true,
	  slidesToShow: 1,
	  arrows: false,
	  autoplay: true,
	  autoplaySpeed: 8000,
	  pauseOnHover: true
	});
	
	$('.testimonialright').slick({
	  dots: true,
	  infinite: true,
	  slidesToShow: 1,
	  arrows: false,
	  autoplay: true,
	  autoplaySpeed: 8000,
	  pauseOnHover: true
	});
	
	// small images slider function
	$('.halfwidthright').slick({
	  dots: true,
	  infinite: true,
	  slidesToShow: 1,
	  autoplay: true,
	  autoplaySpeed: 3000,
	  arrows: false,
	  pauseOnHover: false,
	  responsive: [
		{
		  breakpoint: 768,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		}
	  ]
	});
	
	//portfolioslider
	// small images slider function
	$('.portfolioslider').slick({
	  dots: false,
	  infinite: true,
	  slidesToShow: 1,
	  autoplay: true,
	  autoplaySpeed: 3000,
	  arrows: true,
	  pauseOnHover: false,
	  responsive: [
		{
		  breakpoint: 768,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		}
	  ]
	});
	
	
	//responsive menu
	$(function() {
    var html = $('html, body'),
        navContainer = $('.nav-container'),
        navToggle = $('.nav-toggle'),
        navDropdownToggle = $('.has-dropdown');

    // Nav toggle
    navToggle.on('click', function(e) {
        var $this = $(this);
        e.preventDefault();
        $this.toggleClass('is-active');
        navContainer.toggleClass('is-visible');
        html.toggleClass('nav-open');
    });
   
    // Nav dropdown toggle
    navDropdownToggle.on('click', function() {
        var $this = $(this);
        $this.toggleClass('is-active').children('ul').toggleClass('is-visible');
    });
  
    // Prevent click events from firing on children of navDropdownToggle
    navDropdownToggle.on('click', '*', function(e) {
        e.stopPropagation();
    });
	});
	
	// animation
	new WOW().init();
	
	// Porgress bar animation
	   $(".move").each(function() {
				$(this)
					.data("origWidth", $(this).width())
					.width(0)
					.animate({
						width: $(this).data("origWidth")
					}, 1500);
			});
	
	// number counter
	$('.counter').counterUp({
			delay: 10,
			time: 1000
		});
	//

	// portfolio function
	$(window).load(function(){
		if($('div').hasClass('portfoliodiv'))
		{
    var $container = $('.portfoliodiv');
    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });
		}
	$('.portfolioFilter ul li a').click(function(){
        $('.portfolioFilter .active').removeClass('active');
        $(this).addClass('active');
 
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                queue: false
            }
         });
         return false;
    	});
	});
	
	// portfolio 4 page function
	$(window).load(function(){
		if($('div').hasClass('portfoliodiv4'))
		{
	var $container = $('.portfoliodiv4');
    $container.isotope({
        filter: '*',
		layoutMode: 'masonry',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });
		}
	 
    $('.filter ul li a').click(function(){
        $('.filter .active').removeClass('active');
        $(this).addClass('active');
 
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                queue: false
            }
         });
         return false;
    }); 
	});

	// footer form validation function
	
	// Twitter embbed code script
		window.twttr = (function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0],
		t = window.twttr || {};
	  if (d.getElementById(id)) return t;
	  js = d.createElement(s);
	  js.id = id;
	  js.src = "https://platform.twitter.com/widgets.js";
	  fjs.parentNode.insertBefore(js, fjs);
	 
	  t._e = [];
	  t.ready = function(f) {
		t._e.push(f);
	  };
	 
	  return t;
	}(document, "script", "twitter-wjs"));
	
	//Horizontal Tab
      $('[id^="parentHorizontalTab"]').easyResponsiveTabs({
          type: 'default', //Types: default, vertical, accordion
          width: 'auto', //auto or any width like 600px
          fit: true, // 100% fit in a container
          tabidentify: 'hor_1', // The tab groups identifier
          activate: function(event) { // Callback function if tab is switched
              var $tab = $(this);
              var $info = $('#nested-tabInfo');
              var $name = $('span', $info);
              $name.text($tab.text());
              $info.show();
          }
      });
      //Horizontal Tab
       
      //Vertical Tab
      $('[id^="parentVerticalTab"]').easyResponsiveTabs({
          type: 'vertical', //Types: default, vertical, accordion
          width: 'auto', //auto or any width like 600px
          fit: true, // 100% fit in a container
         // closed: 'accordion',  //Start closed if in accordion view
          tabidentify: 'hor_1', // The tab groups identifier
          activate: function(event) { // Callback function if tab is switched
              var $tab = $(this);
              var $info = $('#nested-tabInfo2');
              var $name = $('span', $info);
              $name.text($tab.text());
              $info.show();
          }
      });        
      //Vertical Tab
		
//main function over
});
})(jQuery);

