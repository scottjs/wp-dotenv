#!/bin/bash

# Config file
SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do
	DIR="$( cd -P "$( dirname "$SOURCE" )" && pwd )"
	SOURCE="$( readlink "$SOURCE" )"
	[[ $SOURCE != /* ]] && SOURCE="$DIR/$SOURCE"
done

DIR="$( cd -P "$( dirname "$SOURCE" )" && pwd )"

CONFIG=${DIR%/*/*/*}

# Import config settings
source "$CONFIG/.env"

cp "$CONFIG/vendor/scottjs/wp-dotenv/wp-config-sample.php" "$CONFIG$APP_WEB_ROOT/wp-config.php"

if [[ $1 = "salts" ]]; then
	SALT=$(curl -L https://api.wordpress.org/secret-key/1.1/salt/)
	STRING='put your unique phrase here'
	printf '%s\n' "g/$STRING/d" a "$SALT" . w | ed -s $CONFIG$APP_WEB_ROOT/wp-config.php
fi

echo WordPress config generated
