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
define('DB_NAME', 'dailoc');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '[{[>:xo!0#Y))n[)DG)x$z{t%)93x`-cM;(A8 !`)ASq|W3Kk7T^/f}eXcl=; {Z');
define('SECURE_AUTH_KEY',  'e,Q``bzR]55r8N/znYBz^)HG{o:dQZ>E7} V@ozeU,cMlxSWV!(e^UZUKE(?}tjT');
define('LOGGED_IN_KEY',    '98<g 7<3}Zxwmz J?S&Zbg7%3|gO)k@-Sj/9UxwjvWsVc]0ktMakF=,7P+WVyCw{');
define('NONCE_KEY',        'ydCf;t[cgxK_4lQ^8Rv-p@x2TFyknrDpzp1/35|5f}S3lN B@TQ#&9t^A=C;O6OV');
define('AUTH_SALT',        ';~.8EcZ<.d5PR*y#FWJB-jM0ex[3fvz|D#8uMH{/LV4^Bt,#Hus78<NdmUEYsknK');
define('SECURE_AUTH_SALT', 'y^lSJZ8,L0&;vgz3F/J`p$aSklj++DI&wnW9tv|/]F=UFdWcm6nQ*D]ep9k*T5O#');
define('LOGGED_IN_SALT',   'S;wO%0&2?v*ruRXAl+%}z`s`L](>0svGo.oO -^otH[8tq4Lb@@.:0jKnjDK.e)C');
define('NONCE_SALT',       '~nE4v-K4.&yya>AoxJKN]?Up$&>CSc<Ij}aI{QAt5]jK%?l_V3ScI>6BXNAnoeC8');

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
