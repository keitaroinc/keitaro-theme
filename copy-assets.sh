#!/bin/bash

assetsPath=assets/js

echo "🔔 Copying required Font file assets from node_modules..."

fontAssets=(
	"node_modules/@fortawesome/fontawesome-free/webfonts/."
)

for asset in ${fontAssets[@]}
do
	echo ✅ $asset
	cp -r $asset assets/fonts
done

echo "🔔 Copying required CSS assets from node_modules..."

cssAssets=(
	"node_modules/prismjs/themes/prism-okaidia.css"
	"node_modules/prismjs/plugins/toolbar/prism-toolbar.css"
)

for asset in ${cssAssets[@]}
do
	echo ✅ $asset
	cp $asset assets/css
done

echo "🔔 Copying required JS assets from node_modules..."

jsAssets=(
	"node_modules/jquery/dist/jquery.min.js"
	"node_modules/bootstrap/dist/js/bootstrap.min.js"
	"node_modules/prismjs/prism.js"
	"node_modules/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"
	"node_modules/prismjs/plugins/toolbar/prism-toolbar.min.js"
)

for asset in ${jsAssets[@]}
do
	echo ✅ $asset
	cp $asset $assetsPath
done

echo "🔔 Minifying JS assets..."

find $assetsPath -type f -name "*.js" ! -name "*.min.js" -exec echo {} \; -exec npx uglifyjs -m -o {}.min {} \;
find $assetsPath -type f -name "*.js.min" -exec rename -f 's/\.js\.min$/.min.js/' {} \;

echo "✅ Done"
