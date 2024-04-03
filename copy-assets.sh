#!/bin/bash

cssAssets=(
	"node_modules/prismjs/themes/prism-okaidia.css"
	"node_modules/prismjs/plugins/toolbar/prism-toolbar.css"
)

jsAssets=(
	"node_modules/jquery/dist/jquery.min.js"
	"node_modules/bootstrap/dist/js/bootstrap.min.js"
	"node_modules/prismjs/prism.js"
	"node_modules/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"
	"node_modules/prismjs/plugins/toolbar/prism-toolbar.min.js"
)

echo "🔔 Copying required CSS assets from node_modules..."

for asset in ${cssAssets[@]}
do
	echo ✅ $asset
	cp $asset assets/css
done

echo "🔔 Copying required JS assets from node_modules..."

for asset in ${jsAssets[@]}
do
	echo ✅ $asset
	cp $asset assets/js
done

echo "🔔 Minifying JS assets..."

find assets/js/ -type f \
    -name "*.js" ! -name "*.min.js" \
    -exec echo {} \; \
    -exec npx uglifyjs -o {}.min.js {} \;

echo "✅ Done"
