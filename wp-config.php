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
define( 'DB_NAME', 'tienda-2' );

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
define( 'AUTH_KEY',         ';P@zO lV)|?zCSp;JyQC#w!_3VRp[|w51%L muz/~Ao[`)E)oY9`OF?[PD2Ix4#F' );
define( 'SECURE_AUTH_KEY',  '+>|x#n@gdnFXWf0[pS:!7W+.u/bc/S$4/8LWHyxk:IZ_,1*f@X+|ctV|zh=xtL&W' );
define( 'LOGGED_IN_KEY',    'UTS`_VBj~i5$m&;W1dz{%r%P$kSs*U`^t`Il!^3$53S,qz-lXO(WG^)Sf8Y&sO3f' );
define( 'NONCE_KEY',        'RBB}K d),tSLYYL^x{*{A~;s.joNTN1SVCT5(.v%#l58k)&%i]b0_BlfGD|XJx~y' );
define( 'AUTH_SALT',        '+w7$XHCN.CKJa7[K(yGSdj`>%n9k-eu,Aw7OI/DcStm)!9D/NvLJzJ/TPxO(6%rQ' );
define( 'SECURE_AUTH_SALT', '!6;ulc#bg%J0SPtI~~#J4m>jio=8lM-_]/nF}$dxeS38kFXi@5^KI?U]7P?]t%M,' );
define( 'LOGGED_IN_SALT',   '#=FQyaLkvm*!q92Pd%&yw~t%R!Dz/0&1z&%$do.}h8$l+QHJER!jHt=zE},H&Q>Z' );
define( 'NONCE_SALT',       ' *@BGQN#RFn/93U9DMUx0oE{!6tS+J/<A[2>4JhT&,X}08M1T#;}n)FbDAPY~I~`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
