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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'spiker' );

/** MySQL database username */
define( 'DB_USER', 'spiker' );

/** MySQL database password */
define( 'DB_PASSWORD', 'bnaCyMfZWy' );

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
define( 'AUTH_KEY',         'Odmd$`S3Y+fOT-gX:obu&Hi1Q)wzr!l6QGt@h.aU#zFb{Q-?8[]72#!zOY3PY-EJ' );
define( 'SECURE_AUTH_KEY',  '(!u2$m(d~otaCkq!M:eBE:3ETt^4Ece^n<qEMMqKbvM_8%egVw1^YY`IHLGI.7zB' );
define( 'LOGGED_IN_KEY',    '!nzPJv|kTbsO`<IvvckAb~www}Y=)1+.x~.YF-[[VBC24fO3c7!52{:pp=Ht[N{F' );
define( 'NONCE_KEY',        '_8Ea+.<5f]=.{q&2t]t8TRO~ !s_ {V%u;Yqaf,CO03W0g.r!O@e/35kUM,,mIuR' );
define( 'AUTH_SALT',        'sl$$,g GY!AL87(QIZrGcqdT@|osCHcZ+WVx:BAUo}^2oRb*ELu U?e`5:^APiVE' );
define( 'SECURE_AUTH_SALT', 'xb[*</{Gqrx-4FuT4,xz==54(xW y3]%RzTh~529`zsfKA={C[W?yCd&]BqLDV)J' );
define( 'LOGGED_IN_SALT',   '{BDfQ=*siQ52}|i9aC5<=O$dhmFaI,NrzHQ^+Ev1A_l~JU9 kz~Ut^m&6T2>^@3v' );
define( 'NONCE_SALT',       'P:FMXx+},1ys)+an c}L7Ksu?_8?@yn1SUf&Q{f_ALa@Y;V=M`=(<MQO<EMfi%BE' );

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
/*define( 'WP_DEBUG', true );*/

/*define('FORCE_SSL_ADMIN', true);*/
define( 'DISALLOW_FILE_EDIT', true );


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

