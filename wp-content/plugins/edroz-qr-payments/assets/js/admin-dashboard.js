jQuery(function ($) {
    $(document).on('click', '.edroz-pro-config', function () {
        var method = $(this).data('method') || 'este método';
        var modal = $('.edroz-pro-modal');
        modal.find('.edroz-pro-modal-message').text(method + ' está disponible en Edroz QR Payments PRO. Escríbenos para conocer cómo activarlo.');
        modal.prop('hidden', false).addClass('is-open');
    });
    $(document).on('click', '.edroz-pro-modal-close, .edroz-pro-modal', function (event) {
        if ($(event.target).closest('.edroz-pro-modal-card').length && !$(event.target).hasClass('edroz-pro-modal-close')) return;
        $('.edroz-pro-modal').prop('hidden', true).removeClass('is-open');
    });
    $(document).on('change', '.edroz-yape-toggle', function () {
        var toggle = $(this);
        var enabled = toggle.is(':checked') ? 'yes' : 'no';
        var status = toggle.closest('.edroz-payment-main, .edroz-free-yape-main').find('[data-status]');

        toggle.prop('disabled', true);

        $.post(EdrozQRAdmin.ajaxUrl, {
            action: 'edroz_qr_toggle_yape',
            nonce: EdrozQRAdmin.nonce,
            enabled: enabled
        }).done(function (response) {
            if (response && response.success && response.data) {
                status.text(response.data.label);
                toggle.attr('data-enabled', response.data.enabled);
                return;
            }
            toggle.prop('checked', enabled !== 'yes');
            window.alert(EdrozQRAdmin.i18n.error);
        }).fail(function () {
            toggle.prop('checked', enabled !== 'yes');
            window.alert(EdrozQRAdmin.i18n.error);
        }).always(function () {
            toggle.prop('disabled', false);
        });
    });
});
