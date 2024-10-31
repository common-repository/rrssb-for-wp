(function($) {
    'use strict';

    $(function() {
        $('.rrssb-buttons')
            .rrssb({
                // required:
                title: rrssb_vars.title,
                url: rrssb_vars.url,
                description: rrssb_vars.description
            });
    });

})(jQuery);
