#!/bin/bash

read -p "Enter a replace value for project name (My Project Name): " proj_name
read -p "Enter a lower-case replace value for namespace (mpn): " proj_ns_lower
read -p "Enter an upper-case replace value for namespace (MPN): " proj_ns_upper
read -p "Enter file-friendly project name (my-project-name): " proj_name_lower

cd ./wp-content

grep -ilr 'WPinabox' * | xargs -I@ sed -i '' "s/WPinabox/$proj_name/g" @
grep -ilr 'wpb' * | xargs -I@ sed -i '' "s/wpb/$proj_ns_lower/g" @
grep -ilr 'WPB' * | xargs -I@ sed -i '' "s/WPB/$proj_ns_upper/g" @
grep -ilr 'wpinabox' * | xargs -I@ sed -i '' "s/wpinabox/$proj_name_lower/g" @

cd -