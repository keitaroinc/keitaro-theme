// img block
(function (blocks, components, i18n, element) {
  var el = element.createElement;

  var RichText = wp.editor.RichText; // For creating editable elements.
  var MediaUpload = wp.editor.MediaUpload;
  var IconButton = components.IconButton;
  blocks.registerBlockType(

    // The name of our block. Must be a string with prefix. Example: my-plugin/my-custom-block.
    'keitaro/custom-careers-block', {

    // The title of our block.
    title: i18n.__('Keitaro-Careers-Block'),

    // Dashicon icon for our block.
    icon: 'megaphone',

    // The category of the block.
    category: 'common',

    // Necessary for saving block content.
    attributes: {
      description: {
        type: 'array',
        source: 'children',
        selector: 'p',
      },
      title: {
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
      mediaIDONE: {
        type: 'number',
      },
      mediaURL: {
        type: 'string',
        source: 'attribute',
        selector: '.left-box-image',
        attribute: 'src',
      },
      mediaURLONE: {
        type: 'string',
        source: 'attribute',
        selector: '.right-box-career-image',
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
            className: ' ', style: { textAlign: alignment }
          },
            el(RichText, {
              tagName: 'p',
              inline: true,
              placeholder: i18n.__('Write the text here...'),
              value: attributes.description,
              onChange: function (newDescription) {
                props.setAttributes({ description: newDescription });
              },
              focus: focusedEditable === 'description' ? focus : null,
              onFocus: function (focus) {
                props.setFocus(_.extend({}, focus, { editable: 'description' }));
              },
            }),
            el(RichText, {
              tagName: 'h1',
              inline: true,
              placeholder: i18n.__('Write the title here...'),
              value: attributes.title,
              onChange: function (newTitle) {
                props.setAttributes({ title: newTitle });
              },
              focus: focusedEditable === 'title' ? focus : null,
              onFocus: function (focus) {
                props.setFocus(_.extend({}, focus, { editable: 'title' }));
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
            el(RichText, {
              tagName: 'p',
              inline: true,
              placeholder: i18n.__('Write the type here...(amplus or microkubes or leave blank)'),
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
              el('div', { className: ' col-lg-5 col-12 my-4 py-4 px-4 careers-block-text' },
                //el('img', { src: attributes.mediaURLONE, className: 'img-fluid right-box-image' }),
                el('h1', { className: 'custom-block-title' }, attributes.title),
                el('p', { className: '' }, attributes.description),
              ),
            ),
            el('div', { className: 'row no-gutters products-right-content flex-row-reverse' },
              el('div', { className: 'custom-block-absolute left-blocks-color-' + color.toString().toLowerCase() }),
              el('div', { className: 'col-lg-5 col-12 ', },
                el('div', { className: "custom-block-description-left" },
                  // el('p', { className: '' }, attributes.description),
                  // el('p', { className: 'custom-block-title' }, attributes.title),
                  el('img', { src: attributes.mediaURLONE, className: 'img-fluid right-box-career-image' }),
                ),
                el('p', { className: 'blocks-hidden' }, attributes.position),
                el('p', { className: 'blocks-color' }, attributes.color),
              ),
              el('div', { className: 'col-lg-7 col-12 products-left-image' },
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
              el('div', { className: ' col-lg-5 col-12 my-4 py-4 px-4 careers-block-text' },
                //el('img', { src: attributes.mediaURLONE, className: 'img-fluid right-box-image' }),
                el('h1', { className: 'block-link btn' }, attributes.title),
                el('p', { className: '' }, attributes.description),
              ),
            ),
            el('div', { className: 'row no-gutters products-right-content' },
              el('div', { className: 'custom-block-absolute right-blocks-color-' + color.toString().toLowerCase() }),
              el('div', { className: 'col-lg-5 col-12 ', },
                el('div', { className: "custom-block-description-right" },
                  // el('p', { className: '' }, attributes.description),
                  // el('h1', { className: 'block-link btn' }, attributes.title),
                  el('img', { src: attributes.mediaURLONE, className: 'img-fluid right-box-career-image' }),
                ),
                el('p', { className: 'blocks-hidden' }, attributes.position),
                el('p', { className: 'blocks-color' }, attributes.color),
              ),
              el('div', { className: 'col-lg-7 col-12 products-right-image' },
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