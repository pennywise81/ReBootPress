"use strict";

(function () {

  jQuery(document).ready(function ($) {
    $('button.hamburger').click(function () {
      $(this).toggleClass('is-active');
      window.console && window.console.log && console.log('TOGGLING HAMBURGER');
    });
  });

})(jQuery);