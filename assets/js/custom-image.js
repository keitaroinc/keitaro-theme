/*
 * Adapted from: http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
 */
(function ($) {
    $(document).ready(function ($) {
        var customImageBtnAdd = $('.custom-image');
        var customImageBtnRemove = $('.custom-image-remove');

        /* Uploading files */
        var file_frame;


// KONTROLIRAJ GI FUNKCIONALNOSTITE PO PARENT, NE ZA SITE ELEMENTI
// MOZNO E DA TREBA DA SETIRASH I ID-A

        customImageBtnRemove.on('click', function (event) {
            customImageBtnRemove$('.custom-image-value').val('');
            customImageBtnRemove.parent().parent().closest('input[name*="savewidget"]')[0].click();
        });

        customImageBtnAdd.on('click', function (event) {

            event.preventDefault();

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
                customImageBtnAdd.parent().find('.current-custom-image').attr('src', attachment.url);
                customImageBtnAdd.parent().find('.custom-image-value').val(attachment.id);
                customImageBtnAdd.parent().parent().closest('input[name*="savewidget"]')[0].click();
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