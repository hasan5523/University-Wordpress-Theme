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
define( 'DB_NAME', 'university' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '3a8{3$M;?%%aDr6CgznQ^{#8+p.mNO*a|#4@!nd)v<KUp6mL9NaCn+[j=aq>{PXK' );
define( 'SECURE_AUTH_KEY',  '!cVhk%I2(7*v#.~=-*)WdT:BD9,)6EP buct`)T&1|~Y*.M^xgDNx`p@1]Sijm/n' );
define( 'LOGGED_IN_KEY',    ';9}(Sx^X91n<ryODmp 1*A >r-<G:3sVjA_ /jezGYZj.XnL6b8e1)?&-POjvP-8' );
define( 'NONCE_KEY',        '!F%Fb6(1AtZ/,VnBPqaO=FRj&Gw;CU7(ocd3|vf582BcgAqdcc%A1/}/v*n}MKR?' );
define( 'AUTH_SALT',        'I!&psHg>5]2`/1qgz~YoRPe0NfDD=#@#>>=}U;<2<`rv6P6Hh2*od=[j30V37F(3' );
define( 'SECURE_AUTH_SALT', 'x(pRy!iyKrMr$!~oS?do`RbKJZ9&UeL7X}+!mF]&0N^.8b[_)Jd:dNah`=qfPA{q' );
define( 'LOGGED_IN_SALT',   'ly1EyA:C]]@iItzE>T[=i%`NHP>QybhAwaLv.4Za}?U{h@#W2w1oF[}I+F.gI%MQ' );
define( 'NONCE_SALT',       'os,abJt&H@s+~.qJE@oT[Y8!_Pykf(>o=a8t_qH0~IiT-qsW8OKlw)T*82ARkDLv' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
