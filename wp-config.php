<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u215584044_qOqQc' );

/** Database username */
define( 'DB_USER', 'u215584044_aQj7o' );

/** Database password */
define( 'DB_PASSWORD', '2rBo5cwvGe' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'z3tl Q//~5[m^)<i19X=T#m{lgO5K|9X?QJGS,dkFLPT/##+en;<t8b =WKaiwFo' );
define( 'SECURE_AUTH_KEY',   '$8Y.$(on{m2,Kw%k7(7_F[7Fr^K%/Q;r~X3JmxyE.@[~&^U4czk[fJktB3Hzb_YB' );
define( 'LOGGED_IN_KEY',     'NR,j;D(v-`ai0[i=z*|d(H=*G/,_v&q_l_RvM9eR Dc.j x70| *UzoR_4P={CW+' );
define( 'NONCE_KEY',         '&,@sXEqB_^*Mv?Kdt:r_TL!^B@UT9x#,?^Yo*@UvWpSZnt]xb7[gg.Z_L1rivf?9' );
define( 'AUTH_SALT',         '}=5n]J!`I&}]#|>!3gv%!SypU`g&?c5P6gq%Pt U.J.83+A3=PH_$Y?<]<~_8QEI' );
define( 'SECURE_AUTH_SALT',  '|p<&M**BZ1m|i|2d@2i-wsrVE4pU{g?vKgef77]@Mw&gJa~UeqrLD%S:f+B@Uc~Q' );
define( 'LOGGED_IN_SALT',    '.0X1Oqq291fT%&]7jPKf~CWPZ$ak{ucp#Ek5=f<g8G7_=64%Pog%?Mq6M7Jt(^r=' );
define( 'NONCE_SALT',        '/fe<De:*1Ep)aGqIE*,r$sx9h`Zx%=tu@{>vUL {DS;Whi[`_h.-5R?Z3g%q5&j<' );
define( 'WP_CACHE_KEY_SALT', 'zz3STcm,8_)za6L[N;+:xt51Q-YUeVl--sD)=Y?L&^[+iK#vg+b5@9?w&vC^?yn[' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', 'a4b90448f03094f3c310cd7e026cde1d' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
