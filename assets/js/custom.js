(function ($) {

    $(document).ready(function () {

        var iframeWrap = $('.location-map-iframe-wrap');
        var activateClass = 'activate-map';

        iframeWrap.on('click', function () {
            $(this).addClass(activateClass);
        });

        iframeWrap.on('mouseout', function () {
            $(this).removeClass(activateClass);
        });

    });

})(jQuery);