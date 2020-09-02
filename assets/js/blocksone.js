
// img block
(function (blocks, components, i18n, element) {
  var el = element.createElement;

  var RichText = wp.editor.RichText; // For creating editable elements.
  var MediaUpload = wp.editor.MediaUpload;
  var IconButton = components.IconButton;
  blocks.registerBlockType(

    // The name of our block. Must be a string with prefix. Example: my-plugin/my-custom-block.
    'keitaro/products-service-block', {

    // The title of our block.
    title: i18n.__('Keitaro-Products-Block'),

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
      name: {
        type: 'array',
        source: 'children',
        selector: 'h1',
      },
      position: {
        type: 'array',
        source: 'children',
        selector: '.blocks-hidden',
      },
      color: {
        type: 'array',
        source: 'children',
        selector: '.blocks-color',
      },
      mediaID: {
        type: 'number',
      },
      mediaURL: {
        type: 'string',
        source: 'attribute',
        selector: 'img',
        attribute: 'src',
      },
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
            el(RichText, {
              tagName: 'p',
              inline: true,
              placeholder: i18n.__('Write the position here...'),
              value: attributes.position,
              onChange: function (newPosition) {
                props.setAttributes({ position: newPosition });
              },
              focus: focusedEditable === 'position' ? focus : null,
              onFocus: function (focus) {
                props.setFocus(_.extend({}, focus, { editable: 'position' }));
              },
            }),
            el(RichText, {
              tagName: 'p',
              inline: true,
              placeholder: i18n.__('Write the type here...(exp Amplus)'),
              value: attributes.color,
              onChange: function (newColor) {
                props.setAttributes({ color: newColor });
              },
              focus: focusedEditable === 'color' ? focus : null,
              onFocus: function (focus) {
                props.setFocus(_.extend({}, focus, { editable: 'color' }));
              },
            }),
          ),
          el('div', {
            className: 'nelio-testimonial-content', style: { textAlign: alignment }
          },
            el(RichText, {
              tagName: 'h1',
              inline: true,
              placeholder: i18n.__('Write the name here...'),
              value: attributes.name,
              onChange: function (newName) {
                props.setAttributes({ name: newName });
              },
              focus: focusedEditable === 'name' ? focus : null,
              onFocus: function (focus) {
                props.setFocus(_.extend({}, focus, { editable: 'name' }));
              },
            }),
          ),
        )
      ];
    },
    save: function (props) {

      var attributes = props.attributes;
      var color = attributes.color;
      if (attributes.position.toString().toLowerCase().includes("left")) {
        return (
          el('div', { className: ' ' },
            el('div', { className: ' row flex-row-reverse mx-0' },

              // right part of the box - logo and content
              el('div', { className: ' col-lg-6 col-12 my-4 py-4 text-center' },
                el('h1', { className: 'custom-block-title' }, attributes.name),
              ),
            ),
            el('div', { className: 'row no-gutters products-right-content flex-row-reverse' },
              el('div', { className: 'custom-block-absolute left-blocks-color-' + color.toString().toLowerCase() }),
              el('div', { className: 'col-lg-6 col-12', },
                el('div', { className: "custom-block-description-left" },
                  el('p', { className: '' }, attributes.testimonial),
                ),
                el('p', { className: 'blocks-hidden' }, attributes.position),
                el('p', { className: 'blocks-color' }, attributes.color),
              ),
              el('div', { className: 'col-lg-6 col-12 products-left-image' },
                el('img', { src: attributes.mediaURL, className: 'img-fluid left-box-image' }),
              ),

            ),
          )
          // end of return
        );
      } else {
        return (
          el('div', { className: ' ' },
            el('div', { className: ' row mx-0' },

              // right part of the box - logo and content
              el('div', { className: ' col-lg-6 col-12 my-4 py-4 text-center' },
                el('h1', { className: 'custom-block-title' }, attributes.name),
              ),
            ),
            el('div', { className: 'row no-gutters products-right-content' },
              el('div', { className: 'custom-block-absolute right-blocks-color-' + color.toString().toLowerCase() }),
              el('div', { className: 'col-lg-6 col-12', },
                el('div', { className: "custom-block-description-right" },
                  el('p', { className: '' }, attributes.testimonial),
                ),
                el('p', { className: 'blocks-hidden' }, attributes.position),
                el('p', { className: 'blocks-color' }, attributes.color),
              ),
              el('div', { className: 'col-lg-6 col-12 products-right-image' },
                el('img', { src: attributes.mediaURL, className: 'img-fluid left-box-image' }),
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