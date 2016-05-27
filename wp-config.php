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
define('DB_NAME', 'verulease');

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
define('AUTH_KEY',         '+]Cgfy+`JZCXJBoaS4J-B.{:3LTurR0q,_llj3o${dh{e6szkDfS1:(wX}$%xx5e');
define('SECURE_AUTH_KEY',  '%I`q=d7ZWB6Lgi!%3^WT|lYT-=MQ~IOp|_*DMJ9_9uF7w;+= D`^WrT[~;}mD`CE');
define('LOGGED_IN_KEY',    'eQsA-MOF|,+@!=_gVatmc[,i]`Z~?=t?;7TW1Qv/|{lXc03I7G$y ;:9Grqz;&hm');
define('NONCE_KEY',        'ww h^7.pB>a1DM!<2]mB>Rt}>-|[BBxA!y&}+_H!t^HBz|RiJ,oG&G*-ol+[Em..');
define('AUTH_SALT',        '8#|Zq2=L=iIfi-iR`6m|1zaXEg-A.t1W.QpJ/OQXnZ2[|Lou}<Wi<>-.yBo0$a%c');
define('SECURE_AUTH_SALT', 'XCt=?gSV+ENo`.9Ex}T_=pBT`hgG+%>+KYAM^@*7&!xnWT)mh#cl;V)kfz~u!;@D');
define('LOGGED_IN_SALT',   'zt):P7l--pZ-|7O_O+0pV;[L~0U,.b<yuOzW7ka~n/+N0*`s(!(>:h!Tr?-S&gb7');
define('NONCE_SALT',       'ah`A$}DF**-PVrP>f-b^KSSzzMdSG^y~W[&&F<pkkRZqK|ek /_i{+leb??9N-g=');

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

define('FS_METHOD','direct');
