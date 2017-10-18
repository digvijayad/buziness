(function($) {
    var style = $('#induspress-color-scheme-css'),
        api = wp.customize;

    if (!style.length) {
        style = $('head').append('<style type="text/css" id="induspress-color-scheme-css" />')
            .find('#induspress-color-scheme-css');
    }
    // Color Scheme CSS.
    api.bind('preview-ready', function() {
        api.preview.bind('update-color-scheme-css', function(css) {
            style.html(css);
        });
    });
})(jQuery);