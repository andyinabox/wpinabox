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

read -p "Enter file-friendly project name (my-project-name): " proj_name_lower


if [ "$(whoami)" != "vagrant" ]; then
#    echo "This script must be run as vagrant user. vagrant ssh and try again." 1>&2
#    exit 1
   vagrant -c "WPB_PROJ_NAME=$proj_name_lower; cd /srv/www/$proj_name_lower/public_html; ./init.sh"
else

    proj_name_lower=$WPB_PROJ_NAME
    read -p "Enter a replace value for project name (My Project Name): " proj_name
    read -p "Enter a lower-case replace value for namespace (mpn): " proj_ns_lower
    read -p "Enter an upper-case replace value for namespace (MPN): " proj_ns_upper
    read -p "What's your ACF Pro API key? " acf_pro_key

    theme_name="$proj_name_lower-theme"
    plugin_name="$proj_name_lower-plugin"
    replace_path="./wp-content/"

    echo "renaming theme to $theme_name"
    mv wp-content/themes/wpinabox-theme "wp-content/themes/$theme_name"

    echo "renaming plugin to $plugin_name"
    mv wp-content/plugins/wpinabox-plugin/wpinabox-plugin.php "wp-content/plugins/wpinabox-plugin/$plugin_name.php"
    mv wp-content/plugins/wpinabox-plugin "wp-content/plugins/$plugin_name"

    echo "creating .env file"
    cp .env-example .env

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
    wp plugin activate "$plugin_name"
    wp theme activate "$theme_name"

    echo "deleting the init script"
    rm init.sh

    echo "done!"
fi