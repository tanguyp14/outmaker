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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'YnneHr1aeS30E37OoDR8VihoZTSLxCTyf9CYgT4w2LeMuNAGNMaeCysCdkn0aRyp0OiTtkT0njr1Y4DhDEbc+Q==');
define('SECURE_AUTH_KEY',  'PWALATgcT1OoIZmHYmruVLljVev/tZNIZtQCGl4/RGgKNODsmVcZkLdIJRsYYiNoNEi3XdYA+haeHPpUZ5fJ3A==');
define('LOGGED_IN_KEY',    'NsQgdGHI6OnO9zBNyG49BD628sFU0tE4/TwEIkplgI7weXe7P04HlF0KNKLZfmQPrki/m2TAxG9gNCv+o2kN+w==');
define('NONCE_KEY',        'y2olOcIaXbvFN3SWSUuSXOjiWo0wiJ88bGoK5AWeBmd1l16ocYCgUDdcjPCqp7BcfI5ygV3ssFSgUPo+kNE9eA==');
define('AUTH_SALT',        's5z1nBnN2mXyG9oszI3+NSm5lzAGBEhZ6dGvSuIyh0DluFZdyR9xfFJU3/7hcl8T3aiIRPQt1HtOeFb+np5l5Q==');
define('SECURE_AUTH_SALT', 'opZsR1MZBUeWdNtIKsXz5N4qdnFSWrM0PeOWM5i22PdrnLjDBN1ghJK+Hsi44Vc8O3w2+8U1VNCMfmTPon9/ag==');
define('LOGGED_IN_SALT',   'HrqqnQ8iJUFd1xrzk9E1sRezP5tooIa/BvcrxtfJLA0dXS9fLVahHLVDaDKH1IuLQhfFjIjq7hLHT0oW4hg/XQ==');
define('NONCE_SALT',       'LNlEOsGAYF4GaRGwiIfyqNcjfKaA9D9zL2yiuaC7NrA9tEJaZWGMmLYqlXcfA9LB6rAGm6KPsXsXply7fpqdig==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/* Inserted by Local by Flywheel. Fixes $is_nginx global for rewrites. */
if (strpos($_SERVER['SERVER_SOFTWARE'], 'Flywheel/') !== false) {
	$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.10.1';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
