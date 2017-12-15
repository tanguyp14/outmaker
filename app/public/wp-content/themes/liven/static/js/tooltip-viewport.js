 (function ($) {
	"use strict";
jQuery(document).ready(function ($) {
  $('.tooltip-right').tooltip({
    placement: 'right',
    viewport: {selector: 'body', padding: 2}
  })
  $('.tooltip-bottom').tooltip({
    placement: 'bottom',
    viewport: {selector: 'body', padding: 2}
  })
  $('.tooltip-top').tooltip({
    placement: 'top',
    viewport: {selector: 'body', padding: 2}
  })
  $('.tooltip-left').tooltip({
    placement: 'left',
    viewport: {selector: 'body', padding: 2}
  })
})
})(jQuery);