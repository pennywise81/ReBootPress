"use strict";

(function () {

  jQuery(document).ready(function ($) {
    $('[data-toggle="offcanvas"]').click(function () {
      $('.row-offcanvas').toggleClass('active');
      window.console && window.console.log && console.log('TOGGLING OFFCANVAS');
    });
  });

})(jQuery);