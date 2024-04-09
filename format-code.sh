#!/bin/bash

# Search for PHP syntax errors.
find -L . -name '*.php' -print0 | xargs -0 -n 1 -P 4 php -l

# WordPress Coding Standards.
phpcbf -p -v -n . --standard=./phpcs.xml --extensions=php
