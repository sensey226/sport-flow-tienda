(function ($) {
    "use strict";

    // Install + Activate button
    $("#install-activate-button").on("click", function (e) {
        if ( $(this).data("activated") ) {
            return;
        }
        e.preventDefault();

        var button = $(this);
        button.prop("disabled", true)
              .text("Installing & Activating recommended plugins…")
              .addClass("processing-spinner");

        $.post(sports_association_localize.ajax_url, {
            action: "sports_association_install_and_activate_plugins",
            nonce: sports_association_localize.nonce
        }, function (response) {
            if (response.success) {
                window.location.href = sports_association_localize.redirect_url;
            } else {
                button.text(response.data?.message || "Installation failed");
            }
        });
    });

})(jQuery);
