<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'indiainfocom' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'admin@123' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '0]jPa9fyKeP+nw84z3rI/Y1?)~e3k&pMLdsrW%DToaEMZL60ELV*gN#oMf?RRu!u' );
define( 'SECURE_AUTH_KEY',  'e%O]=C)E6#2jyDpeXaKJu8AT-(ABzju?*3@$}i!wK#A{ne#1[^wWW=ljvK)Bjy<{' );
define( 'LOGGED_IN_KEY',    ']0l$7?38%,cQ8hOvMeB] L*4>?1Vvcj66O}_l31!c/Ch$PpKO_lVP ~vy1CT#85L' );
define( 'NONCE_KEY',        'j%GD1.Ult$(I2/:q9Rt+cfm3)R,!I`#Faz>1ol;lr<TF>:;DH-*ur]CssG~805>O' );
define( 'AUTH_SALT',        'g}z3Z-J[@AN-78[6=)Mr=FSg^!O+)j=J|S My8fi+;[C^Bw8H. E69}k$G!Nw&!B' );
define( 'SECURE_AUTH_SALT', 'Y$[WQSdq/k_w3ov2?i7?5.E)!hs9j]X%J{}UZ1bs^h$die0q7j}Y(/Wx^9&z]Q^O' );
define( 'LOGGED_IN_SALT',   '`,k:|xp7Y$DQvY+/Zh/ZxqT7_@n2~fmsXyJTSqlMI4BcA+X_2L MP}K-J0Y(4Iyb' );
define( 'NONCE_SALT',       ']_=>nygU=42s<t|tjyp_7//E4uvOY44o!u3k `9`?QgXf?boy:Oc#!RO/#mA!coV' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'infocom_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
