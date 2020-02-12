#!/bin/bash
# Search for PHP syntax errors.
find -L . -name '*.php' -print0 | xargs -0 -n 1 -P 4 php -l

# WordPress Coding Standards.
phpcs -p -s -v -n . --standard=./phpcs.xml --extensions=php

# Run the theme JavaScript partials through ESLint
# eslint -v -c ./.eslintrc.js ./assets/scripts/concat

# Run the theme LESS partials through LESS Lint.
# lesslint assets/less/*.less
