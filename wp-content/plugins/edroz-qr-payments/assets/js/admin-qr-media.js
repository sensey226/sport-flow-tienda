(function ($) {
    'use strict';
    $(document).on('click', '.edroz-media-button', function (event) {
        event.preventDefault();
        var field = $(this).closest('.edroz-qr-picker').find('input[name="qr_url"]');
        if (!field.length) {
            field = $('input[name="woocommerce_yapepay_qr_url"]');
        }
        if (!field.length || typeof wp === 'undefined' || !wp.media) return;
        var frame = wp.media({ title: 'Seleccionar código QR', button: { text: 'Usar esta imagen' }, multiple: false, library: { type: 'image' } });
        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            field.val(attachment.url).trigger('change');
            var preview = field.closest('.edroz-field').find('.edroz-qr-preview');
            if (preview.length) preview.attr('src', attachment.url);
            else $('<img class="edroz-qr-preview" alt="Vista previa del código QR">').attr('src', attachment.url).insertAfter(field.closest('.edroz-qr-picker'));
        });
        frame.open();
    });
})(jQuery);
