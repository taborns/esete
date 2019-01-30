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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'esete');

/** MySQL database username */
define('DB_USER', 'tabor');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '+HGt BzKyd)[_$rU1-:>%IlfgK+T*ctlq`t^7-QGXXt;)d3&%x{-MN%-7Pu4m*(R');
define('SECURE_AUTH_KEY',  '%;o~]6^Go_ss;BN,q#4x9kR+2&RY#|<,I?W,%C!3<H|G*(#<;5&)I3RmC;v[>H!4');
define('LOGGED_IN_KEY',    '45<tHJWbHvHDdA8vB7dJTs:)?2aeLA?#^5PFgHt`Isq1X(@C+[AR>(]CCvTj(bP@');
define('NONCE_KEY',        'rWPf0MXb3&si+|#N#:&9A@bAcg1ax:kl4j. v(3q$RybQaokj<*UMgW7uc[#|9.J');
define('AUTH_SALT',        'Y!lcRJq5l@c|[|)jEBYmV~[14=K<#>;sS5wCTN1NDoxO^Gdj)!%O/Tak(E*LKf4A');
define('SECURE_AUTH_SALT', 'L*^D/5s%LczC@~ZKa7aS(=y:B:L m.j[d0;]qEaxQL/zK2qJW@%&EH!e2Mg>|MtV');
define('LOGGED_IN_SALT',   'u<~`v3[rwn#0Lmws[=5=+ZB}0l|aT0-!+b$)OSZ k7_gS`tFL?~o{M!gzZ50|Agg');
define('NONCE_SALT',       'fKUy1FM5S(,GlN/W/s;+`}YIw:4$CbIa0Sx9ua_ lc-AB4i-nr*( 4Pqzk*odp}D');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
