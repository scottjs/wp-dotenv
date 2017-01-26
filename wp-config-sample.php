<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */


/**
 * Include Dotenv library to pull config options from .env file.
 */
if(file_exists(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
	$dotenv = new Dotenv\Dotenv(__DIR__);
	$dotenv->load();
}
if(file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
	require_once dirname(__DIR__) . '/vendor/autoload.php';
	$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
	$dotenv->load();
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('DB_DATABASE'));

/** MySQL database username */
define('DB_USER', getenv('DB_USERNAME'));

/** MySQL database password */
define('DB_PASSWORD', getenv('DB_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', getenv('DB_HOST'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', getenv('APP_DEBUG') == 'true' ? true : false);

if(getenv('APP_ENV') != 'local') {
	define('AUTOMATIC_UPDATER_DISABLED', true);
	define('DISALLOW_FILE_EDIT', true);
	define('DISALLOW_FILE_MODS', true);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . getenv('APP_CORE') != '' ? getenv('APP_CORE') : '/');

/** Automatically set paths */
define('WP_HOME', (getenv('APP_SSL') == 'true' ? 'https://' : 'http://') . (getenv('APP_WWW') == 'true' ? 'www.' : '') . str_replace('www.', '', $_SERVER['HTTP_HOST']));
define('WP_SITEURL', (getenv('APP_SSL') == 'true' ? 'https://' : 'http://') . (getenv('APP_WWW') == 'true' ? 'www.' : '') . str_replace('www.', '', $_SERVER['HTTP_HOST']) . getenv('APP_CORE'));

/** Configure directory paths if WP core is in a different directory */
if(getenv('APP_CORE') != '') {
	define('WP_CONTENT_URL', WP_HOME . '/wp-content');
	define('WP_CONTENT_DIR', realpath(ABSPATH.'../wp-content/'));
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');