FOLDER=/var/www/html/storage/framework
if [ ! -d "$FOLDER" ]; then
    echo "$FOLDER is not a directory, creating" 
    mkdir /var/www/html/storage/framework
fi

FOLDER=/var/www/html/storage/framework/sessions
if [ ! -d "$FOLDER" ]; then
    echo "$FOLDER is not a directory, creating" 
    mkdir /var/www/html/storage/framework/sessions
fi

FOLDER=/var/www/html/storage/framework/views
if [ ! -d "$FOLDER" ]; then
    echo "$FOLDER is not a directory, creating" 
    mkdir /var/www/html/storage/framework/views
fi

FOLDER=/var/www/html/storage/framework/cache
if [ ! -d "$FOLDER" ]; then
    echo "$FOLDER is not a directory, creating" 
    mkdir /var/www/html/storage/framework/cache
fi