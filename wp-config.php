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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nafiri' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '3V17]V3#Ma)pFO^+xE?.k0wC_QnK`<KM?}&W44MnOx+18[LJIbDaK(1WpVqP~~Q@' );
define( 'SECURE_AUTH_KEY',  '.WSy=1z.)iX HqQ8y{/-t::dw43iXiRJ<q-m$[@W3a<Lf_hsJUO*cOe<q!c=`zcL' );
define( 'LOGGED_IN_KEY',    '%ho8,S/99?c(|=@63cm-qAPE@WYcG!^B:z_5jyAa3 vT|N+Qb/Kv`j!QG/eN>R<Q' );
define( 'NONCE_KEY',        'h]4c?5PBhf%lT;/!SKcu*%.Bjue0xwuH8k[iQ$0$>;de,tOftb)g(3P]T!};iAfg' );
define( 'AUTH_SALT',        'gS9Tii><7MD2EYU**qtW tpT=nnAhChGBfIc+3xA[ud>_0<dUt_W|y(tj$OfARn`' );
define( 'SECURE_AUTH_SALT', 'v]!1#?B/K?>}GHV`k/}3}2K+:CH,l;4s=:[tPlMAK2&Ves#gHaF:.o]z6ZiHlPV)' );
define( 'LOGGED_IN_SALT',   '_MFohTHg]c>MEGkM0rY*#|0|J.8$mj]X49UPgQE%cUf 4B#?:<<LdVOUBoZV#ev-' );
define( 'NONCE_SALT',       'pO~Z<55X;T~l~S/RE_)T2|D(&5C[w{a 16UZaAF}%NB-j8-Rfboo8:D!4HONCqQ~' );

/**#@-*/

/**
 * WordPress database table prefix.
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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
