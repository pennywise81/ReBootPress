"use strict";

(function () {

  jQuery(window).load(function () {
    var b = jQuery('body');

    if (b.hasClass('fixed-footer')) {
      var f = jQuery('footer.main'), h = jQuery('html'), fh = f.outerHeight();

      window.console && window.console.log && console.log('STICKY FOOTER INIT, HEIGHT: ' + fh);

      h.css({
        position: 'relative',
        minHeight: '100%'
      });

      if (h.hasClass('admin-bar')) {
        var abh = jQuery('#wpadminbar').height();

        h.css({
          minHeight: 'calc(100% - ' + abh + 'px)'
        });
      }

      b.css({
        marginBottom: fh + 'px'
      });

      f.css({
        bottom: 0,
        height: fh + 'px',
        position: 'absolute'
      });
    }
  });

})(jQuery);