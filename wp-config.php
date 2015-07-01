<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpresstest');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'N&d}t(D|}$>v**|nQAmYhX|Xt|LdrNpP?cB3:zv9[Y?}.mdzscz0|D>/2w._kO(S');
define('SECURE_AUTH_KEY',  'Wc s|gGLLGZq;=A|DXTe}kG39R[5!|JZdj)u5KCEC_so,2}S!GvCN8fU+:+fnb)4');
define('LOGGED_IN_KEY',    '|?YXsgNuKO^mH8+J~pc5C!8Z<l$KPlL5#nUU}*``*,A%utD##}]r`rW`J~.^<qCf');
define('NONCE_KEY',        '{{4r~)M{T4ERVJ|:~H.ihUv4W@LV$$}9;`hp!ubH-9GzsRgpe#cC|>kH|aLOeXBi');
define('AUTH_SALT',        'y7)9S3.lv!Z&Ny~;]~|r{oCZ(J*F%U M)vo{-;i[Ls3J|P~`vxI<H/9ks~vE^k[l');
define('SECURE_AUTH_SALT', 'ot4sFbyEazdF@NrB2sbRx+DYnLnZ;9v+d&2yuO^u)tha=UH^lf)vVp.t`97IBo>@');
define('LOGGED_IN_SALT',   '7k`$)(B2g)k|jWp0kq-qY`S)ZlN +oMWgd+f-/M|Jj+t=]m3wkVP[mwd++$%i+b7');
define('NONCE_SALT',       '1X($~h,5+)6xR9Q/z?j?&gq~zHQw%LkS5G6z!2^1v^uT07r]V|(Lig.,iKY4[X@s');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
