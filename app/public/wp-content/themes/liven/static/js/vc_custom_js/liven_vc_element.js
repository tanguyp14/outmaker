(function($) {
	'use strict';
    $(document).on('change', '.liven_progressbar_text_position', function(e) {
		if(this.options[e.target.selectedIndex].value == 'above') {
			if(!$('.liven_progressbar_text_align').find("option[value='text-center']").length){
				$('.liven_progressbar_text_align option:first').after($('<option />', { "value": 'text-center', text: 'Center', class: 'text-center' }));
			}
        }else if(this.options[e.target.selectedIndex].value == 'below') {
			if(!$('.liven_progressbar_text_align').find("option[value='text-center']").length){
				$('.liven_progressbar_text_align option:first').after($('<option />', { "value": 'text-center', text: 'Center', class: 'text-center' }));
			}
        }
		else if(this.options[e.target.selectedIndex].value == 'inside')
		{
			 $('.liven_progressbar_text_align').find("option[value='text-center']").remove();
		}
    });
})(jQuery);