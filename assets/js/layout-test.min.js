(function ($) {

    $(document).ready(function () {

        // Find elements in DOM which cause the page to overflow
        var docWidth = document.documentElement.offsetWidth;

        [].forEach.call(
                document.querySelectorAll('*'),
                function (el) {
                    if (el.offsetWidth > docWidth) {
                        console.log(el);
                    }
                }
        );

    });

})(jQuery);