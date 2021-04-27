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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// enables shortcodes in PODS templates
define('PODS_SHORTCODE_ALLOW_SUB_SHORTCODES',true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'perlan_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'nerdpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'xE78o6c2QTk8wJtv' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '^vATK+U0#LH6Gh6#*42Uu-MLtBY1&UhM]4iwZ??PnQ&&4=2AJaJHOA)$k^*t&Kv;' );
define( 'SECURE_AUTH_KEY',  'iK25uO?c(>;[igXM <N0>Yy#J,C{okVWp?B`f}MZ#vFv5LP=N7t>CO}uAj>:DM;O' );
define( 'LOGGED_IN_KEY',    '4bOT~fzr2Tt)_y6P[Ek8.+=m~Q ?#}-MOr%{.E&rjN3PQ1!BR#=K&5<}`41EJ&:=' );
define( 'NONCE_KEY',        '08;>K*U4t$q-o.IuVH[d=ClWggZR)9d6ae?PT+9`g(RZh@<:(+{x*Tde5cy!D@Vl' );
define( 'AUTH_SALT',        '>Q@{rWd(!9A^Mq^dWF[]rNJtS/k%E84j$%FXB,P=B>DjdZ1$X0y.x3QELS~R)XO4' );
define( 'SECURE_AUTH_SALT', 'IJ)Y=h`&YgyzxUSjn*>2XtGYt>: e]$%`gMGrNHrGhgr_^/.Sf7Og]uj0T,}0_m,' );
define( 'LOGGED_IN_SALT',   '+@{7uXcEucN<&g|)zd=3b( KoN..wUz4cTmQlS!wyN/keCB0iRT%PXDDnSac3obx' );
define( 'NONCE_SALT',       '7c*uV,}S~2_luOIe5:s>e8DAZRlvtG4u7x}~wJ%RzYJ*#Mz6|)(My9VenlDbw<[P' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
