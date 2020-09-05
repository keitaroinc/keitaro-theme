
// img block
(function (blocks, components, i18n, element) {
  var el = element.createElement;

  var RichText = wp.editor.RichText; // For creating editable elements.
  blocks.registerBlockType(

    // The name of our block. Must be a string with prefix. Example: my-plugin/my-custom-block.
    'keitaro/list-block', {

    // The title of our block.
    title: i18n.__('Keitaro-List-Block'),

    // Dashicon icon for our block.
    icon: 'megaphone',

    // The category of the block.
    category: 'common',

    // Necessary for saving block content.
    attributes: {
      content: {
        type: 'array',
        source: 'children',
        selector: 'ul',
      },
      desciption: {
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
    },

    edit: function (props) {
      var attributes = props.attributes;
      var focus = props.focus;
      var focusedEditable = props.focus ? props.focus.editable || 'name' : null;

      return el(
        'div',
        { className: props.className },

        //name
        el(RichText, {
          tagName: 'h1',
          placeholder: 'NAME GOES HERE',
          value: attributes.name,
          onChange: function (value) {
            props.setAttributes({ name: value });
          },
          className: 'name',
        }),

        //description
        el(RichText, {
          tagName: 'p',
          placeholder: 'DESCRIPTION GOES HERE',
          value: attributes.desciption,
          onChange: function (value) {
            props.setAttributes({ desciption: value });
          },
          className: 'description',
        }),

        // lista
        el(RichText, {
          tagName: 'ul',
          key: 'editable',
          placeholder: 'LIST GOES HERE',
          value: attributes.content,
          multiline: 'li',
          multilineWrapperTags: ['ul'],
          isSelected: attributes.isSelected,
          onChange: function (value) {
            props.setAttributes({ content: value });
          },
          className: 'content-custom-list',
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
      );
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
            el('div', { className: 'row no-gutters products-right-content' },
              el('div', { className: 'custom-block-absolute left-list-blocks-color-' + color.toString().toLowerCase() }),
              el('div', { className: 'col-lg-6 col-12 order-2 career-ul-list-' + color.toString().toLowerCase() },
                el(RichText.Content, {
                  tagName: 'ul',
                  className: 'list',
                  value: attributes.content,
                })
              ),
              el('div', { className: 'col-lg-6 order-1 order-lg-12 col-12', },
                el('div', { className: "custom-block-description-left" },
                  el('p', { className: '' }, attributes.desciption),
                ),
                el('p', { className: 'blocks-hidden' }, attributes.position),
                el('p', { className: 'blocks-color' }, attributes.color),
              ),
            ),
          )
          // end of return bellow
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
              el('div', { className: 'custom-block-absolute right-list-blocks-color-' + color.toString().toLowerCase() }),
              el('div', { className: 'col-lg-6 col-12', },
                el('div', { className: "custom-block-description-right" },
                  el('p', { className: '' }, attributes.desciption),
                ),
                el('p', { className: 'blocks-hidden' }, attributes.position),
                el('p', { className: 'blocks-color' }, attributes.color),
              ),
              el('div', { className: 'col-lg-6 col-12 career-ul-list-' + color.toString().toLowerCase() },
                el(RichText.Content, {
                  tagName: 'ul',
                  className: 'list',
                  value: attributes.content,
                })
              ),
            ),
          )
          // end of return bellow
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