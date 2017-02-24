#!/bin/bash

# read -p "Enter a replace value for project name (My Project Name): " proj_name
read -p "Enter a lower-case replace value for namespace (mpn): " proj_ns_lower
# read -p "Enter an upper-case replace value for namespace (MPN): " proj_ns_upper
# read -p "Enter file-friendly project name (my-project-name): " proj_name_lower

cd ./wp-content



find . -type f -name "*.php" -exec sed -i'' "s/wpb/$proj_ns_lower/g" {} +

# git grep -lz wpb | xargs -0 sed -i '' -e "s/wpb/$proj_ns_lower/g"

# find . -name "*.[a-z]*" -print0 | xargs -0 sed -i '' -e "s/WPinabox/$proj_name/g"
# find . -name "*.php" -print0 | xargs -0 sed -i '' -e "s/wpb/$proj_ns_lower/g"
# find . -name "*.[a-z]*" -print0 | xargs -0 sed -i '' -e "s/MPN/$proj_ns_upper/g"
# find . -name "*.[a-z]*" -print0 | xargs -0 sed -i '' -e "s/my-project-name/$proj_name_lower/g"

cd -