#!/bin/bash

# while read file; do
#   sed -i '' "s/WPB/MPN/g" $file
# done <./bin/files.txt



read -p "Enter a replace value for project name (My Project Name): " proj_name
read -p "Enter a lower-case replace value for namespace (mpn): " proj_ns_lower
read -p "Enter an upper-case replace value for namespace (MPN): " proj_ns_upper
read -p "Enter file-friendly project name (my-project-name): " proj_name_lower
read -p "What's your ACF Pro API key? " acf_pro_key

theme_name="themes/$proj_name_lower-theme" 

# cd ./wp-content

# echo "replacing names..."

grep -rl WPinabox wp-content | while read file
do
  sed -i '' "s/WPinabox/$proj_name/g" $file
done

grep -rl wpb wp-content | while read file
do
  sed -i '' "s/wpb/$proj_ns_lower/g" $file
done

grep -rl WPB wp-content | while read file
do
  sed -i '' "s/WPB/$proj_ns_upper/g" $file
done

grep -rl wpinabox wp-content | while read file
do
  sed -i '' "s/WPB/$proj_name_lower/g" $file
done


# echo "installing composer dependencies"
echo "ACF_PRO_KEY=$acf_pro_key" > .env
composer install

# echo "activating theme and plugins"
wp plugin activate advanced-custom-fields-pro
wp plugin activate timber-library
wp theme activate "$theme_name"

# echo "removing git repository"
# rm -rf .git
