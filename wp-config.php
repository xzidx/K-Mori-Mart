<?php
define('DB_NAME', 'xzidx_');
define('DB_USER', 'xzidx_');
define('DB_PASSWORD', '#Nang087884298');
define('DB_HOST', 'localhost');

$table_prefix = 'wp_';

define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

define('AUTH_KEY',         'your-generated-key-here');
define('SECURE_AUTH_KEY',  'your-generated-key-here');
define('LOGGED_IN_KEY',    'your-generated-key-here');
define('NONCE_KEY',        'your-generated-key-here');
define('AUTH_SALT',        'your-generated-key-here');
define('SECURE_AUTH_SALT', 'your-generated-key-here');
define('LOGGED_IN_SALT',   'your-generated-key-here');
define('NONCE_SALT',       'your-generated-key-here');
define('FS_METHOD', 'direct');
define('WP_DEBUG', false);

define('WP_HOME', 'http://K_Mori_Mart_website.test');
define('WP_SITEURL', 'http://K_Mori_Mart_website.test');

if ( !defined('ABSPATH') )
    define('ABSPATH', __DIR__ . '/');

require_once ABSPATH . 'wp-settings.php';

