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
define( 'DB_NAME', 'DataSinko' );

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
define( 'AUTH_KEY',         'E0&A|6`H8}](iv57c2a2v8?RQ7>]NpkyK{ifjZ  l-O/Tt?&Z=WhZ.F7.>:N.%^Q' );
define( 'SECURE_AUTH_KEY',  ']_</$NE|geofmWfD4:n-_3Q# m~Y&jNOlOrI{]a2;NFN@~M^JiAKYc#E DzzsX]S' );
define( 'LOGGED_IN_KEY',    'BD>y2I <ma5QM_JiZy;9Sbez^4hL+*%Tw)n(uj:Z1Bn `5{].y A:e.Vu}2#6IvA' );
define( 'NONCE_KEY',        '1(!/hVtwPPJ0#s4ex<vbXxWWsI;89#g93`)FEn+e7rHDkVRw=9?}alPc_asuhio:' );
define( 'AUTH_SALT',        'cs[:%YSCD?Q:3Aw&Iu3R{q9v#DO36ESZ);O!wP!;g)o%V}ha$:Zib;Er-J9}q,=#' );
define( 'SECURE_AUTH_SALT', 'M`CJO0OZ1F_y;ZN>)4yQP5<y/G4MCoJrlM$6x&T9DWjXSy^L5Q*)8&%%)GD|d:7E' );
define( 'LOGGED_IN_SALT',   'sgUMtaL^.Dh-|SvfB^@6$LX}VN~2zS<qvMIn3aftB(hB}Q eARQ@zZFQk`6p@6[{' );
define( 'NONCE_SALT',       '4J<1d*S>]%Eb$HdrcL[kEbEa c]ZvbNqlyLIzX%<tmW )~]&qq;(@`h.x5Z&y:Q6' );

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
