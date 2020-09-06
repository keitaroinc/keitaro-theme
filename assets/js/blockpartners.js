(function (blocks, components, i18n, element) {
  var el = element.createElement;

  var RichText = wp.editor.RichText; // For creating editable elements.
  var MediaUpload = wp.editor.MediaUpload;
  var IconButton = components.IconButton;
  blocks.registerBlockType(

    // The name of our block. Must be a string with prefix. Example: my-plugin/my-custom-block.
    'keitaro/custom-partner-block', {

    // The title of our block.
    title: i18n.__('Keitaro-Partners-Block'),

    // Dashicon icon for our block.
    icon: 'megaphone',

    // The category of the block.
    category: 'common',

    // Necessary for saving block content.
    attributes: {
      content: {
        type: 'array',
        source: 'children',
        selector: 'p',
      },
      position: {
        type: 'array',
        source: 'children',
        selector: '.blocks-hidden',
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
        selector: '.big-partners-img',
        attribute: 'src',
      },
      mediaURLONE: {
        type: 'string',
        source: 'attribute',
        selector: '.small-partners-img',
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
              className: attributes.mediaID ? ' image-active' : ' image-inactive',
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
              className: attributes.mediaIDONE ? ' image-active' : ' image-inactive',
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
            className: '', style: { textAlign: alignment }
          },
            el(RichText, {
              tagName: 'p',
              inline: true,
              placeholder: i18n.__('Write the text here...'),
              value: attributes.content,
              onChange: function (newContent) {
                props.setAttributes({ content: newContent });
              },
              focus: focusedEditable === 'content' ? focus : null,
              onFocus: function (focus) {
                props.setFocus(_.extend({}, focus, { editable: 'content' }));
              },
            }),
            el(RichText, {
              tagName: 'p',
              inline: true,
              placeholder: i18n.__('Main image position...(left or right)'),
              value: attributes.position,
              onChange: function (newPosition) {
                props.setAttributes({ position: newPosition });
              },
              focus: focusedEditable === 'position' ? focus : null,
              onFocus: function (focus) {
                props.setFocus(_.extend({}, focus, { editable: 'position' }));
              },
            }),
          ),
        )
      ];
    },

    save: function (props) {

      var attributes = props.attributes;

      if (attributes.position.toString().toLowerCase().includes("left")) {

        return (
          el('div', { className: ' ' },
            el('div', { className: ' row mx-0' },
              el('div', { className: ' col-12 col-lg-5 partners-img-wrapper' },
                el('img', { src: attributes.mediaURL, className: ' big-partners-img img-fluid' }),
                el('div', { className: ' partners-absolute-left' },
                  el('img', { src: attributes.mediaURLONE, className: 'small-partners-img' }),
                )
              ),

              el('div', { className: ' col-12 col-lg-6' },
                el('div', { className: ' partners-text-wrapper-left' },
                  el('p', { className: ' ' }, attributes.content),
                  el('p', { className: 'blocks-hidden' }, attributes.position),
                ),
              ),

            ),
          )
          // end of return
        );
      } else {

        return (
          el('div', { className: ' ' },
            el('div', { className: ' row flex-row-reverse mx-0' },
              el('div', { className: ' col-12 col-lg-5 partners-img-wrapper' },
                el('img', { src: attributes.mediaURL, className: ' big-partners-img img-fluid' }),
                el('div', { className: ' partners-absolute-right' },
                  el('img', { src: attributes.mediaURLONE, className: 'small-partners-img' }),
                )
              ),

              el('div', { className: ' col-12 col-lg-6' },
                el('div', { className: ' partners-text-wrapper-right' },
                  el('p', { className: ' ' }, attributes.content),
                  el('p', { className: 'blocks-hidden' }, attributes.position),
                ),
              ),

            ),
          )
          // end of return
        );
      }
    },

  });

})(
  window.wp.blocks,
  window.wp.components,
  window.wp.i18n,
  window.wp.element,
  window.wp.editor,
);