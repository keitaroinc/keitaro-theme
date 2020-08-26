
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
      ingredients: {
        type: 'string',
        source: 'html',
        selector: '.list',
        query: {
          val: {
            type: 'string',
            selector: 'li',
            source: 'text',
          },
        },
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
          placeholder: 'LIST GOES HERE',
          value: attributes.ingredients,
          onChange: function (value) {
            props.setAttributes({ ingredients: value });
          },
          className: 'ingredients',
        })
      );
    },
    save: function (props) {
      var attributes = props.attributes;
      var content = '';
      var ingredients = '';
      if (attributes.ingredients) {
        if (attributes.ingredients.includes('<br>')) {
          ingredients = attributes.ingredients.split('<br>');
          for (var i = 0; i < ingredients.length; i++) {
            content =
              content +
              '<li class="list-item' +
              (i + 1) +
              '">' +
              ingredients[i] +
              '</li>';
          }
        } else {
          ingredients = attributes.ingredients.split('</li>');
          for (var i = 0; i < ingredients.length; i++) {
            if (i == ingredients.length - 1) {
              content = content + ingredients[i];
            } else {
              content = content + ingredients[i] + '</li>';
            }
          }
        }
      }
      //<i class="fas fa-check"></i>

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
              el('p', { className: 'products-description' }, attributes.desciption),
            ),
            el('div', { className: 'col-lg-6 col-12 block-right-list' },
              el(RichText.Content, {
                tagName: 'ul',
                className: 'list',
                value: content,
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