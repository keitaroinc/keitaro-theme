const { registerBlockType } = wp.blocks;
// img block
(function (blocks, components, i18n, element) {
  var el = element.createElement;

  var RichText = wp.editor.RichText; // For creating editable elements.
  var MediaUpload = wp.editor.MediaUpload;
  var IconButton = components.IconButton;
  blocks.registerBlockType(

    // The name of our block. Must be a string with prefix. Example: my-plugin/my-custom-block.
    'keitaro/custom-block', {

    // The title of our block.
    title: i18n.__('Keitaro-Block'),

    // Dashicon icon for our block.
    icon: 'megaphone',

    // The category of the block.
    category: 'common',

    // Necessary for saving block content.
    attributes: {
      testimonial: {
        type: 'array',
        source: 'children',
        selector: 'p',
      },
      mediaID: {
        type: 'number',
      },
      mediaIDONE: {
        type: 'number',
      },
      mediaURL: {
        type: 'string',
        source: 'attribute',
        selector: 'img',
        attribute: 'src',
      },
      mediaURLONE: {
        type: 'string',
        source: 'attribute',
        selector: 'img',
        attribute: 'src',
      }
    },

    edit: function (props) {
      var focus = props.focus;
      var focusedEditable = props.focus ? props.focus.editable || 'name' : null;
      var alignment = props.attributes.alignment;
      var attributes = props.attributes;

      var onSelectImage = function (media) {
        return props.setAttributes({
          mediaURL: media.url,
          mediaID: media.id,
        });
      };
      var onSelectImageOne = function (media) {
        return props.setAttributes({
          mediaURLONE: media.url,
          mediaIDONE: media.id,
        });
      };

      function onChangeAlignment(newAlignment) {
        props.setAttributes({ alignment: newAlignment });
      }

      return [
        !!focus && el( // Display controls when the block is clicked on.
          blocks.BlockControls,
          { key: 'controls' },
          el(
            blocks.AlignmentToolbar,
            {
              value: alignment,
              onChange: onChangeAlignment,
            }
          ),
        ),
        el('div', { className: props.className },
          el('div', {
          },
            el('div', {
              className: attributes.mediaID ? 'nelio-testimonial-image image-active' : 'nelio-testimonial-image image-inactive',
              style: attributes.mediaID ? { backgroundImage: 'url(' + attributes.mediaURL + ')', width: 200, height: 200, backgroundSize: 'cover' } : {}
            }),
            el(MediaUpload, {
              onSelect: onSelectImage,
              type: 'image',
              value: attributes.mediaID,
              render: function (obj) {
                return el(IconButton, {
                  className: attributes.mediaID ? 'button button-large' : 'button button-large',
                  style: { margin: 10 },
                  onClick: obj.open
                },
                  !attributes.mediaID ? i18n.__('Upload Image') : i18n.__('Upload Image')
                );
              }
            }),
          ),
          el('div', {
          },
            el('div', {
              className: attributes.mediaIDONE ? 'nelio-testimonial-image image-active' : 'nelio-testimonial-image image-inactive',
              style: attributes.mediaIDONE ? { backgroundImage: 'url(' + attributes.mediaURLONE + ')', width: 200, height: 200, backgroundSize: 'cover' } : {}
            }),
            el(MediaUpload, {
              onSelect: onSelectImageOne,
              type: 'image',
              value: attributes.mediaIDONE,
              render: function (obj) {
                return el(IconButton, {
                  className: attributes.mediaIDONE ? 'button button-large' : 'button button-large',
                  style: { margin: 10 },
                  onClick: obj.open
                },
                  !attributes.mediaIDONE ? i18n.__('Upload Image Title') : i18n.__('Upload Image Title')
                );
              }
            }),
          ),
          el('div', {
            className: 'nelio-testimonial-content', style: { textAlign: alignment }
          },
            el(RichText, {
              tagName: 'p',
              inline: true,
              placeholder: i18n.__('Write the text here...'),
              value: attributes.testimonial,
              onChange: function (newTestimonial) {
                props.setAttributes({ testimonial: newTestimonial });
              },
              focus: focusedEditable === 'testimonial' ? focus : null,
              onFocus: function (focus) {
                props.setFocus(_.extend({}, focus, { editable: 'testimonial' }));
              },
            }),
          ),
        )
      ];
    },

    save: function (props) {

      var attributes = props.attributes;
      return (
        el('div', { className: ' row no-gutters d-flex' },
          attributes.mediaURL && attributes.mediaURLONE &&
          el('div', { className: 'col-md-6 custom-left' },
            el('img', { src: attributes.mediaURL, className: 'img-fluid' }),
          ),
          el('div', { className: ' col-md-5 d-flex custom-right' },
            el('div', { className: 'custom-rights-image', style: { textAlign: attributes.alignment } },
              el('img', { src: attributes.mediaURLONE, className: 'img-fluid' }),
            ),
            el('div', { className: 'custom-rights-text', style: { textAlign: attributes.alignment } },
              el('p', {}, attributes.testimonial),
            )
          ),
        )
      );
    },
  });

})(
  window.wp.blocks,
  window.wp.components,
  window.wp.i18n,
  window.wp.element,
  window.wp.editor,
);