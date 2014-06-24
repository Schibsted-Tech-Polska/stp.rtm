#!/bin/sh
SRC_PATH='module/Api/src/Api'
TMP_PATH='data/build/apidocs'
rm -rf $TMP_PATH && mkdir -p  $TMP_PATH && cp -r $SRC_PATH $TMP_PATH
find $TMP_PATH -type f -exec sed -i'' "s#%BASE_PATH%#$1#g" '{}' \;
php vendor/zircote/swagger-php/swagger.phar $TMP_PATH -o public/docs/json
