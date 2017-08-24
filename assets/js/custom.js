(function ($) {

    $(document).ready(function () {

        var iframeWrap = $('.location-map-iframe-wrap');
        var activateClass = 'activate-map';
        var btnGoToTop = $('.btn-go-to-top');
        var btnGoToTopToggleClass = 'btn-go-to-top-visible';
        var scrollTopOffset = 250;

        iframeWrap.on('click', function () {
            $(this).addClass(activateClass);
        });

        iframeWrap.on('mouseout', function () {
            $(this).removeClass(activateClass);
        });

        // Go to top when .btn-scroll-top is clicked
        btnGoToTop.click(function () {
            $(window).scrollTop(0);
        });

        // Check if top-scrolling offset has been passed
        if ($(this).scrollTop() > scrollTopOffset) {
            btn_go_to_top_show();
        }

        // Show/hide Go To Top button
        $(window).scroll(function () {

            if ($(this).scrollTop() > scrollTopOffset) {
                btn_go_to_top_show();
            } else {
                btn_go_to_top_hide();
            }

        });

        // Add CSS class when Go To Top button is visible
        function btn_go_to_top_show() {
            btnGoToTop.addClass(btnGoToTopToggleClass);
        }

        // Remove CSS class to hive Go To Top button
        function btn_go_to_top_hide() {
            btnGoToTop.removeClass(btnGoToTopToggleClass);
        }

    });

})(jQuery);