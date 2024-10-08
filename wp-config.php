<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'portfolio_DB' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '<%@<d9y4@O:8/H6DD$t;G82[S2%:y5AIY7xfiFXz)55I^ ~{6sP=b;A;Z~kc$Q`B' );
define( 'SECURE_AUTH_KEY',  'bfjZST%?E?qQEVi1CM[KH7p#)2msV!b(9vqKzU7~^P*:vR50J`x--y&~X]h|,N3.' );
define( 'LOGGED_IN_KEY',    '*M*?v14va[7gJT54b1#!gpT.5RU[.RrD!K`Bd,LIo}O*h./!ulE?O-PI0ItaS1?P' );
define( 'NONCE_KEY',        't;Yce@]1;|;3W4i#8}@3.N)Q91m.P=q9a|ouO$c^~ E+p6k2^(~.cW;7$P+nJ&-e' );
define( 'AUTH_SALT',        'V~dC{w)RZ !8IJ6O-S]wgxFnGeD@A34*ZQYb8S;hEJUvGFswg-K^YQxg+]!*ASq9' );
define( 'SECURE_AUTH_SALT', ']#8F_(4ql-@GT3.D<$txutcnCf-:UjL_>$ };oA;BPl5$`WnG`G8?wrNGA~s@0:z' );
define( 'LOGGED_IN_SALT',   '*y3h&V8B^;jXH;6_{x `mA@ab9 ao74m@!}@+O|C%X|h%fyU&LGoI#P$#v&_07TS' );
define( 'NONCE_SALT',       '4`/~vqb8 x:Pt>Vjco+CB5pB~-c52fy^hkz-J3Zi3Y/KStg;K%x=wP_!D>LVeYLd' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'pf_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
