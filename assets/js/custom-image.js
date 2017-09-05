/*
 * Adapted from: http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
 */
(function ($) {
    $(document).ready(function ($) {

        /* Uploading files */
        var file_frame;

        $('.custom-image-remove').on('click', function (event) {
            $(this).parent().parent().find('.custom-image-value').val('');
        });

        $('.custom-image').on('click', function (event) {

            event.preventDefault();
            var parentForm = $(this).parent().parent();

            // If the media frame already exists, reopen it.
            if (file_frame) {
                file_frame.open();
                return;
            }

            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
            title: $(this).attr('data-media-widget-title'),
            button: {
                text: $(this).data('uploader_button_text')
            },
                multiple: false  // Set to true to allow multiple files to be selected
            });

            // When an image is selected, run a callback.
            file_frame.on('select', function () {
                // We set multiple to false so only get one image from the uploader
                attachment = file_frame.state().get('selection').first().toJSON();

                // Do something with attachment.id and/or attachment.url here
                parentForm.find('.current-custom-image').attr('src', attachment.url);
                parentForm.find('.custom-image-value').val(attachment.id);
            });

            //If the uploader object has already been created, reopen the dialog
            if (file_frame) {
                file_frame.open();
                return;
            }

            // Finally, open the modal
            file_frame.open();
        });

    });

})(jQuery);