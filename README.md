# Keitaro Inc. - WordPress Theme

The official WordPress theme of [Keitaro Inc.](http://www.keitaro.com/)

Keitaro offers reliable managed services based on open-source technologies. Our passion for Linux and open-source defines us.

Our mission is continuous improvement and enrichment of our knowledge and expertise by creating unique customer experience and delivering top-notch open-source and Linux-based solutions.

## Requirements

* WordPress 4.8+
* Node.js
* LESS

## Installing required Node.js modules

Run `npm install` to install all required Node.js modules

## Building static assets

Run `gulp` to (re)build all static CSS and JS assets.

## Testing

Execute `run_tests.sh` to validate the codebase with the [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/).

Run `phpcbf . --standard=./phpcs.xml --extensions=php` to automatically resolve coding errors.