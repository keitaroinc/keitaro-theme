
// img block
(function (blocks, components, i18n, element) {
  var el = element.createElement;

  var RichText = wp.editor.RichText; // For creating editable elements.
  blocks.registerBlockType(

    // The name of our block. Must be a string with prefix. Example: my-plugin/my-custom-block.
    'keitaro/career-list-block', {

    // The title of our block.
    title: i18n.__('Keitaro-Career-List-Block'),

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
    },

    edit: function (props) {
      var attributes = props.attributes;

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
        })
      );
    },
    save: function (props) {
      var attributes = props.attributes;
      return (
        el('div', { className: ' ' },
          el('div', { className: ' row ' },

            // right part of the box - logo and content
            el('div', { className: ' col-lg-6 col-12 my-4 py-4 text-center' },
              el('h1', { className: 'custom-block-title' }, attributes.name),
            ),
          ),
          el('div', { className: 'row no-gutters products-right-content' },
            el('div', { className: 'lists-right-absolute' }),
            el('div', { className: 'col-lg-6 col-12', },
              el('p', { className: 'products-description block-list-desc' }, attributes.desciption),
            ),
            el('div', { className: 'col-lg-6 col-12 block-right-list' },
              el(RichText.Content, {
                tagName: 'ul',
                className: 'career-list',
                value: attributes.content,
              })
            ),
          ),
        )
        // end of return bellow
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