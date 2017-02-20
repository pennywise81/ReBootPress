"use strict";

(function () {

  jQuery(document).ready(function ($) {
    window.console && window.console.log && console.log('DOCUMENT READY');

    getSizes();
  });

  jQuery(window).load(function ($) {
    window.console && window.console.log && console.log('WINDOW LOADED');
  });

  var getSizes = function() {
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
      r = parseFloat(window.getComputedStyle(document.querySelector("html"), null).getPropertyValue('font-size')),
      g = 'xs',
      p = Math.round(1/r * 1000) / 1000,
      o = {};

    if (w >= 544 && w < 768) {
      g = 'sm';
    }
    else if (w >= 768 && w < 992) {
      g = 'md';
    }
    else if (w >= 992 && w < 1200) {
      g = 'lg';
    }
    else if (w >= 1200) {
      g = 'xl';
    }

    o = {
      viewportWidth: w,
      remInPixel: r,
      pixelInRem: p,
      gridClass: g
    };

    window.console && window.console.log && console.log(o);

    return o;
  }

})(jQuery);