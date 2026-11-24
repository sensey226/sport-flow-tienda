
// Ouside the list
(function( $ ) {
    wp.customize.panel( 'baseball_sports_club_section_pro_panel', function( panel ) {
        panel.deferred.embedded.done(function() {
            // Create the button
            var button = $('<a class="button baseball_sports_club-pro-btn" href="https://www.webnotickdemo.com/baseball-sports-club/" target="_blank">Go Pro</a>');

            // Append the button to the panel container (outside of accordion-section-title)
            panel.container.append(button);

            // Ensure the button properly redirects
            button.on('click', function(event) {
                event.preventDefault(); // Prevent default behavior
                window.open($(this).attr('href'), $(this).attr('target')); // Redirect to URL
            });
        });
    });
})( jQuery );

