<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'new_dev');

/** MySQL database username */
define('DB_USER', 'hcdev');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', 'admin.happyclick.vn:3300');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'VS$l4y UMc-a$j&oCh=dK8-*c_Z0{,Lff-(&j>yZxj$s7-)ed.)K[yi_k{Fm6w_u');
define('SECURE_AUTH_KEY',  'cgy{rT!W!q&fV1nY9F763,9>R8[H=(F[HVI ?g={Ie8_AA1:-2)gjL{sXV~LCB_n');
define('LOGGED_IN_KEY',    'lGHeg>_{FwHD{p{QN+u{Yf`9(qMooY7Pwo&woTYs*YTpxZUPM+{6acuo`?af=W/E');
define('NONCE_KEY',        'F#aJYEhWW8+?2keXzdMvi%d{&MbEwNXA/3tZN;nRR/`lw1vGp6w^5EQg&)(>~4?z');
define('AUTH_SALT',        '^|]aab2@@R3$-%`J_D@ai,75*w2l5>PFJ@lph0u6{=Uj~~k*2!p/i#c-}CYnN?VM');
define('SECURE_AUTH_SALT', '5QE>G:N>aq1qmZ^Abh5}&4<3jRVUj!s:D<-It!.a) k]2 )kf]mE=i^Khn9.oX;b');
define('LOGGED_IN_SALT',   '9IfZbj3r@8G:=nEs2,R-}3`wV[<>V0qOdG AbH2#nf# `%o4t@|AsvA/]9pW#W2q');
define('NONCE_SALT',       '@f.=T@w~zXj$ypS9n+;L<nM,jAUL6@fW6&<&%mD8zLs_n83J1^X.tgM0pSEiXWV:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
