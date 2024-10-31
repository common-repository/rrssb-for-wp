(function($) {
    'use strict';

    $(function() {
        $('.rrssb-buttons')
            .sortable({
                connectWith: '.rrssb-buttons',
                placeholder: 'placeholder',
                forcePlaceholderSize: true,
            });

        $('.rrssb-active')
            .on('sortremove', function(event, ui) {
                if ($('.rrssb-active li')
                    .length < 1) {
                    $('.rrssb-active')
                        .sortable('cancel');
                }

            });

        $('.rrssb-active')
            .on('sortupdate', function(event, ui) {
                $('#rrssb-for-wp-buttons')
                    .val($('.rrssb-active')
                        .sortable('toArray', {
                            attribute: 'class'
                        }));
            });

    });
})(jQuery);
