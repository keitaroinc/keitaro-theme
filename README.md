# Keitaro Inc. - WordPress Theme

[![phpcs](https://github.com/keitaroinc/keitaro-theme/actions/workflows/phpcs.yml/badge.svg)](https://github.com/keitaroinc/keitaro-theme/actions/workflows/phpcs.yml)

The official WordPress theme of [Keitaro Inc.](http://www.keitaro.com/)

Keitaro offers **reliable managed services based on open-source technologies**. Our passion for Linux and open-source defines us. Our core value is expertise, which we are continuously honing and upgrading in order to meet customers needs. We follow the market and stay on top of latest trends and bleeding edge technologies.

Our mission is continuous improvement and enrichment of our knowledge and expertise by creating unique customer experience and delivering top-notch open-source and Linux-based solutions.

## Requirements

- WordPress 4.8+
- Node.js
- Sass

## Install

Run `npm install` to install all required Node.js modules

## Build

Run `npm run build` to rebuild SCSS assets into CSS once. If you want to watch for changes in the SCSS files, run `npm run dev:build`.

## Assets

Any update of relevant npm packages associated to (S)CSS, JavaScript and fonts, needs to complete with running of the `copy-assets.sh` script, so all the relevant assets are updated with their latest (minified and non-minified) versions.

## Syntax highlighting

Syntax highlighting is available thanks to [Prism](http://prismjs.com/). To enable it, wrap the relevant code with `<pre><code class="language-xxxx"> ... </code></pre>` in a (custom) post or page and set the language class of `<code>`. Please find the list of [languages that Prism supports](http://prismjs.com/#languages-list) on the official website.

Syntactically highlighted code blocks are rendered with the Okaidia theme.

## Test

Execute `run-tests.sh` to validate the codebase with the [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/).

Run `format-code.sh` to automatically resolve coding standard and formatting errors.

## Visual Design

### Custom styles for Gutenberg

There are multiple custom styles available for different Gutenberg components. Below is a brief introduction to all of these custom styles.

#### Group

- **Wrapper** - general-use style for adding extra padding to Group blocks

#### Media & Text

- **Feature** - stylized Media & Text block which reflects the Keitaro brand
- **Feature with Transparent Image** - stylized Media & Text block which reflects the Keitaro brand and has support for transparent, symbol-based images
- **Partner** - stylized Media & Text block for representing organizations partnered with Keitaro

#### Columns

- **Service Group** - stylized Columns block for rendering a group of Services
- **Team Group** - stylized Columns block for rendering a group of team members
- **Feature Group** -  stylized Columns block for rendering a group of blocks that include specific product or service features
- **Feature Group with List** - stylized Columns block for rendering a group of blocks that include specific product or service features, rendered in a List block

#### List

- **List with check marks** - stylized List block for rendering list items with a check mark icon
- **List with circled check marks** - stylized List block for rendering list items with a circled check mark icon

### Making text uppercase

To make any block show all-caps letters, select the relevant block in Gutenberg, expand the **Advanced** section in the right sidebar, enter `text-uppercase` in the **Additional CSS class(es)** input and click Update.

### Adding arrows

Bottom left or bottom right arrows can be added to Group blocks, by assigning the `arrow-left` or `arrow-right` CSS classes. Select the Group block in Gutenberg, expand the **Advanced** section in the right sidebar, enter one of the two CSS classes in the **Additional CSS class(es)** input and click Update.

If you want the arrow to look like a border, _set a background color_ on the Group the CSS classes are added.

### Creating lists with check marks

Create or select a **List** block in Gutenberg and select the relevant custom style preset. The following two are available for selection:

- List with check marks
- List with circled check marks

### Removing extra empty space above and below Groups

To remove the extra empty space above a Group block, select the Group block, expand the **Advanced** section in the right sidebar, enter `no-padding-top` the **Additional CSS class(es)** input and click Update.

To remove the extra empty space below a Group block, select the Group block, expand the **Advanced** section in the right sidebar, enter `no-padding-bottom` the **Additional CSS class(es)** input and click Update.

Entering both CSS classes delimited by a space is also supported.

### Managing spacing

Managing the spacing of any block is possible by assigning a specific CSS class from Bootstrap. Please check the [Spacing](https://getbootstrap.com/docs/4.5/utilities/spacing/) documentation of Bootstrap for further details.

If, for example, you want to change the margins of a specific block, select the relevant block, expand the **Advanced** section in the right sidebar, enter `mt-0`, `ml-0`, `mr-0`, `mb-0`, `mx-0`, `my-0` or `m-0` in the **Additional CSS class(es)** input and click Update.
