#!/bin/bash

if [ "$(whoami)" != "vagrant" ]; then
   echo "This script must be run as vagrant user. vagrant ssh and try again." 1>&2
   exit 1
fi

read -p "Enter a replace value for project name (My Project Name): " proj_name
read -p "Enter a lower-case replace value for namespace (mpn): " proj_ns_lower
read -p "Enter an upper-case replace value for namespace (MPN): " proj_ns_upper
read -p "Enter file-friendly project name (my-project-name): " proj_name_lower
read -p "What's your ACF Pro API key? " acf_pro_key

theme_name="$proj_name_lower-theme"
replace_path="./wp-content/themes/$theme_name"

echo "renaming theme to $theme_name"
mv wp-content/themes/wpinabox-theme "$replace_path"

echo "replacing names..."
find $replace_path -type f -readable -writable -exec sed -i "s/WPinabox/$proj_name/g" {} \;
find $replace_path -type f -readable -writable -exec sed -i "s/wpb/$proj_ns_lower/g" {} \;
find $replace_path -type f -readable -writable -exec sed -i "s/WPB/$proj_ns_upper/g" {} \;
find $replace_path -type f -readable -writable -exec sed -i "s/wpinabox/$proj_name_lower/g" {} \;

echo "installing composer dependencies..."
echo "ACF_PRO_KEY=$acf_pro_key" > .env
composer install

echo "activating theme and plugins..."
wp plugin activate advanced-custom-fields-pro
wp plugin activate timber-library
wp theme activate "$theme_name"

echo "removing git repository..."
rm -rf .git
