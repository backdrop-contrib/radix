/**
 * @file
 * Overrides for CTools modal.
 * See ctools/js/modal.js
 */

(function ($) {
  /**
   * Override CTools modal show function so it can recognize the Bootstrap modal classes correctly
   */
  Backdrop.CTools.Modal.show = function(choice) {
    var opts = {};

    if (choice && typeof choice == 'string' && Backdrop.settings[choice]) {
      // This notation guarantees we are actually copying it.
      $.extend(true, opts, Backdrop.settings[choice]);
    }
    else if (choice) {
      $.extend(true, opts, choice);
    }

    var defaults = {
      modalTheme: 'CToolsModalDialog',
      throbberTheme: 'CToolsModalThrobber',
      animation: 'show',
      animationSpeed: 'fast',
      modalSize: {
        type: 'scale',
        width: 0.8,
        height: 0.8,
        addWidth: 0,
        addHeight: 0,
        // How much to remove from the inner content to make space for the
        // theming.
        contentRight: 25,
        contentBottom: 45
      },
      modalOptions: {
        opacity: .55,
        background: '#fff'
      }
    };

    var settings = {};
    $.extend(true, settings, defaults, Backdrop.settings.CToolsModal, opts);

    if (Backdrop.CTools.Modal.currentSettings && Backdrop.CTools.Modal.currentSettings != settings) {
      Backdrop.CTools.Modal.modal.remove();
      Backdrop.CTools.Modal.modal = null;
    }

    Backdrop.CTools.Modal.currentSettings = settings;

    var resize = function(e) {
      // When creating the modal, it actually exists only in a theoretical
      // place that is not in the DOM. But once the modal exists, it is in the
      // DOM so the context must be set appropriately.
      var context = e ? document : Backdrop.CTools.Modal.modal;

      if (Backdrop.CTools.Modal.currentSettings.modalSize.type == 'scale') {
        var width = $(window).width() * Backdrop.CTools.Modal.currentSettings.modalSize.width;
        var height = $(window).height() * Backdrop.CTools.Modal.currentSettings.modalSize.height;
      }
      else {
        var width = Backdrop.CTools.Modal.currentSettings.modalSize.width;
        var height = Backdrop.CTools.Modal.currentSettings.modalSize.height;
      }

      // Use the additionol pixels for creating the width and height.
      $('div.ctools-modal-dialog', context).css({
        'width': width + Backdrop.CTools.Modal.currentSettings.modalSize.addWidth + 'px',
        'height': height + Backdrop.CTools.Modal.currentSettings.modalSize.addHeight + 'px'
      });
      $('div.ctools-modal-dialog .modal-body', context).css({
        'width': (width - Backdrop.CTools.Modal.currentSettings.modalSize.contentRight) + 'px',
        'height': (height - Backdrop.CTools.Modal.currentSettings.modalSize.contentBottom) + 'px'
      });
    }

    if (!Backdrop.CTools.Modal.modal) {
      Backdrop.CTools.Modal.modal = $(Backdrop.theme(settings.modalTheme));
      if (settings.modalSize.type == 'scale') {
        $(window).bind('resize', resize);
      }
    }

    // First, let's get rid of the body overflow.
    $('body').addClass('modal-open');

    resize();

    $('.modal-title', Backdrop.CTools.Modal.modal).html(Backdrop.CTools.Modal.currentSettings.loadingText);
    Backdrop.CTools.Modal.modalContent(Backdrop.CTools.Modal.modal, settings.modalOptions, settings.animation, settings.animationSpeed);
    $('#modalContent .modal-body').html(Backdrop.theme(settings.throbberTheme));
  };

  Backdrop.CTools.Modal.dismiss = function() {
    if (Backdrop.CTools.Modal.modal) {
      $('body').removeClass('modal-open');
      Backdrop.CTools.Modal.unmodalContent(Backdrop.CTools.Modal.modal);
    }
  };

  /**
   * Provide the HTML for the Modal.
   */
  Backdrop.theme.prototype.CToolsModalDialog = function () {
    var html = ''
    html += '  <div id="ctools-modal">'
    html += '    <div class="ctools-modal-dialog modal-dialog">'
    html += '      <div class="modal-content">'
    html += '        <div class="modal-header">';
    html += '          <button type="button" class="close ctools-close-modal" aria-hidden="true">&times;</button>';
    html += '          <h4 id="modal-title" class="modal-title">&nbsp;</h4>';
    html += '        </div>';
    html += '        <div id="modal-content" class="modal-body">';
    html += '        </div>';
    html += '      </div>';
    html += '    </div>';
    html += '  </div>';

    return html;
  }

  /**
   * Provide the HTML for Modal Throbber.
   */
  Backdrop.theme.prototype.CToolsModalThrobber = function () {
    var html = '';
    html += '  <div class="loading-spinner" style="position: absolute; top: 45%; left: 50%">';
    html += '    <i class="fa fa-cog fa-spin fa-3x"></i>';
    html += '  </div>';

    return html;
  };


})(jQuery);
