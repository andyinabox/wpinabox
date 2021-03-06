#!/bin/bash

# This is a general-purpose function to ask Yes/No questions in Bash, either
# with or without a default answer. It keeps repeating the question until it
# gets a valid answer.
# https://gist.github.com/davejamesmiller/1965569

ask() {
    # http://djm.me/ask
    local prompt default REPLY

    while true; do

        if [ "${2:-}" = "Y" ]; then
            prompt="Y/n"
            default=Y
        elif [ "${2:-}" = "N" ]; then
            prompt="y/N"
            default=N
        else
            prompt="y/n"
            default=
        fi

        # Ask the question (not using "read -p" as it uses stderr not stdout)
        echo -n "$1 [$prompt] "

        # Read the answer (use /dev/tty in case stdin is redirected from somewhere else)
        read REPLY </dev/tty

        # Default?
        if [ -z "$REPLY" ]; then
            REPLY=$default
        fi

        # Check if the reply is valid
        case "$REPLY" in
            Y*|y*) return 0 ;;
            N*|n*) return 1 ;;
        esac

    done
}



if [ "$(whoami)" != "vagrant" ]; then

    # get project dir name
    pushd ../
    project_dir_name="$(basename $PWD)"
    popd

    # we want to do a clean frontend install once everything is done
    rm -rf wp-content/themes/wpinabox-theme/node_modules

    # run install scripts on the vagrant box
    vagrant ssh -c "cd /srv/www/${project_dir_name}/public_html; ./init.sh"
    source .env

    echo "installing frontend dependencies and building"
    pushd "wp-content/themes/${WPB_PROJ_NAME_LOWER}-theme"
        yarn install
        yarn build
    popd

    echo "deleting the init script"
    rm init.sh

    echo "done!"
    
else

    read -p "Enter file-friendly project name (my-project-name): " proj_name_lower
    read -p "Enter a replace value for project name (My Project Name): " proj_name
    read -p "Enter a lower-case replace value for namespace (mpn): " proj_ns_lower
    read -p "Enter an upper-case replace value for namespace (MPN): " proj_ns_upper

    theme_name="$proj_name_lower-theme"
    plugin_name="$proj_name_lower-plugin"
    theme_path="wp-content/themes/$theme_name"
    plugin_path="wp-content/plugins/$plugin_name"

    echo "removing xtra plugins"
    rm wp-content/plugins/hello.php
    rm -r wp-content/plugins/akismet

    echo "removing xtra themes"
    rm -r wp-content/themes/twenty*

    echo "renaming theme to $theme_name"
    mv wp-content/themes/wpinabox-theme $theme_path

    echo "renaming plugin to $plugin_name"
    mv wp-content/plugins/wpinabox-plugin/wpinabox-plugin.php "wp-content/plugins/wpinabox-plugin/$plugin_name.php"
    mv wp-content/plugins/wpinabox-plugin $plugin_path


    echo "replacing names... this may take a while..."

    echo "WPinabox -> ${proj_name}"
    find $theme_path -type f -readable -writable -exec sed -i "s/WPinabox/$proj_name/g" {} \;
    find $plugin_path -type f -readable -writable -exec sed -i "s/WPinabox/$proj_name/g" {} \;

    echo "wpb -> ${proj_ns_lower}"
    find $theme_path -type f -readable -writable -exec sed -i "s/wpb/$proj_ns_lower/g" {} \;
    find $plugin_path -type f -readable -writable -exec sed -i "s/wpb/$proj_ns_lower/g" {} \;

    echo "WPB -> ${proj_ns_upper}"
    find $theme_path -type f -readable -writable -exec sed -i "s/WPB/$proj_ns_upper/g" {} \;
    find $plugin_path -type f -readable -writable -exec sed -i "s/WPB/$proj_ns_upper/g" {} \;

    echo "wpinabox -> ${proj_name_lower}"
    find $theme_path -type f -readable -writable -exec sed -i "s/wpinabox/$proj_name_lower/g" {} \;
    find $plugin_path -type f -readable -writable -exec sed -i "s/wpinabox/$proj_name_lower/g" {} \;

    echo "updating .env"
    sed -i "s/wpinabox/$proj_name_lower/g" .env;
    echo "WPB_PROJ_NAME_LOWER=$proj_name_lower" >> .env
    echo "WPB_PROJ_NAME=$proj_name" >> .env
    echo "WPB_PROJ_NS_LOWER=$proj_ns_lower" >> .env
    echo "WPB_PROJ_NS_UPPER=$proj_ns_upper" >> .env

    echo "installing composer dependencies..."
    composer install

    echo "activating theme and plugins..."

    wp plugin activate advanced-custom-fields-pro
    wp plugin activate timber-library
    wp plugin activate "$plugin_name"
    wp theme activate "$theme_name"
fi