# Keitaro Inc. - WordPress Theme

The official WordPress theme of [Keitaro Inc.](http://www.keitaro.com/)

Keitaro offers **reliable managed services based on open-source technologies**. Our passion for Linux and open-source defines us. Our core value is expertise, which we are continuously honing and upgrading in order to meet customers needs. We follow the market and stay on top of latest trends and bleeding edge technologies.

Our mission is continuous improvement and enrichment of our knowledge and expertise by creating unique customer experience and delivering top-notch open-source and Linux-based solutions.

## Requirements

* WordPress 4.8+
* Node.js
* LESS

## Install

Run `npm install` to install all required Node.js modules

## Build

Run `gulp` to (re)build and minify all static CSS and JS assets.

## Syntax highlighting

Syntax highlighting is available thanks to [Prism](http://prismjs.com/). To enable it, wrap the relevant code with `<pre><code class="language-xxxx"> ... </code></pre>` in a (custom) post or page and set the language class of `<code>`. Please find the list of [languages that Prism supports](http://prismjs.com/#languages-list) on the official website.

Syntactically highlighted code blocks are rendered with the Okaidia theme.

## Test

Execute `run_tests.sh` to validate the codebase with the [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/).

Run `phpcbf . --standard=./phpcs.xml --extensions=php` to automatically resolve coding errors.

## Visual Design

### Adding Arrows

Bottom left or bottom right arrows can be added to Group blocks, by assigning the `arrow-left` or `arrow-right` CSS classes. Select the Group block in Gutenberg, expand the **Advanced** section, enter one of the two CSS classes in the **Additional CSS class(es)** input and click Update.

If you want the arrow to look like a border, *set a background color* on the Group the CSS classes are added.
