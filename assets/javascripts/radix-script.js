/**
 * @file
 * JS for Radix.
 */
(function ($, Backdrop, window, document, undefined) {

  // Show dropdown on hover.
  Backdrop.behaviors.radix_dropdown = {
    attach: function(context, setting) {
      $('.dropdown').once('radix-dropdown', function(){
        // Show dropdown on hover.
        $(this).mouseenter(function(){
          $(this).addClass('open');
        });
        $(this).mouseleave(function(){
          $(this).removeClass('open');
        });
      });
    }
  }

  $(document).ready(function() {
    // Allow main menu dropdown-toggle to be clickable.
    $('#main-menu .dropdown > a.dropdown-toggle').once('radix-dropdown', function(){
      $(this).click(function(e) {
        e.preventDefault();
        window.location.href = $(this).attr('href');
      });
    });
  });
})(jQuery, Backdrop, this, this.document);
