// google map grayscale function
	     google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
				  jQuery("[id^='gmap']").each(function(){
				    var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
					
                    zoom: parseInt(jQuery(this).attr('data-zoom')),

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(jQuery(this).attr('data-latitude'), jQuery(this).attr('data-longitude')), // New York
                    styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
                };
 var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(jQuery(this).attr('data-latitude'), jQuery(this).attr('data-longitude')),
                    map: new google.maps.Map(document.getElementById(jQuery(this).attr('id')), mapOptions),
                    title: 'Snazzy!'
                });
				
				  
					});
					
					jQuery("[id^='dgmap']").each(function(){
				    var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
					
                    zoom: parseInt(jQuery(this).attr('data-zoom')),

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(jQuery(this).attr('data-latitude'), jQuery(this).attr('data-longitude')), // New York
                    styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
                };
 var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(jQuery(this).attr('data-latitude'), jQuery(this).attr('data-longitude')),
                    map: new google.maps.Map(document.getElementById(jQuery(this).attr('id')), mapOptions),
                    title: 'Snazzy!'
                });
				
				  
					});
					
					
					jQuery("[id^='bmap']").each(function(){
				    var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
					
                    zoom: parseInt(jQuery(this).attr('data-zoom')),

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(jQuery(this).attr('data-latitude'), jQuery(this).attr('data-longitude')), // New York
                    styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]
                };
 var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(jQuery(this).attr('data-latitude'), jQuery(this).attr('data-longitude')),
                    map: new google.maps.Map(document.getElementById(jQuery(this).attr('id')), mapOptions),
                    title: 'Snazzy!'
                });
				
				  
					});
            }