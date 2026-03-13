<?php




define( 'ITSEC_ENCRYPTION_KEY', 'ZzpkcFd0eXUrZjE8dkMofW9GfUdzKDN6ISFQQzV5RTdxX2xuM1MoLSsycEVsSyFfUSo5PXBGS0RBWHBBRFFdTQ==' );

# Database Configuration
define( 'DB_NAME', 'wp_thefountainspa' );
define( 'DB_USER', 'thefountainspa' );
define( 'DB_PASSWORD', 'hC5GFBv_pBQhexPc5WYJ' );
define( 'DB_HOST', '127.0.0.1:3306' );
define( 'DB_HOST_SLAVE', '127.0.0.1:3306' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'k)^fTK3~;+Phr{S@iKkPp%eAhs#-.2nN|e:I[>nv1^dqi2fAa+-iv!yM?*V-+^,x');
define('SECURE_AUTH_KEY',  'h )g.E}wKjQ87&QSDZ#]8<,UoS-MBAg 2l?.+r#A(lq{{*oGNi.n?cuV+}Q[|iO+');
define('LOGGED_IN_KEY',    'D_e^+@}w(h4/sn]-w6q{CJpf+,Op|RT|[V+_*z$+Ez>Gpb*DjYmC]RGZ`s(1#c~H');
define('NONCE_KEY',        '^#U2<_|V?2:V0~2Oy-v=#7,g$P)pE)-h5YsVIp]:.M9[nh~):]cIPw23&-e_fQas');
define('AUTH_SALT',        '_Vhi@q1~Ddu<(yZDo@XQ^^:?$g>N1}V:v-s4=5=C=r2<dQ<mi`3/zeR7MU2B_ Ii');
define('SECURE_AUTH_SALT', 'Gh|O{)1|Az6QMoIF`+`+-GlLh(mA`)-%geSJZ8tsaL[i}V8S,Ki?g&J._$F?kRg2');
define('LOGGED_IN_SALT',   'V-m/o}s_]iZ7g=MR&C(y{R$U=,xb;G6}eTu+Sppyft[4V,|EwRQ,N-+vQ63M4g-B');
define('NONCE_SALT',       'p0GCR3R{;^$lxidDF?k4!^uPmYbo58-sW(u_V171lrd%W_xNlukOG6zQm_Wzi=2>');


# Localized Language Stuff



define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'thefountainspa' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'WPE_APIKEY', 'd72d895cb93145aea0900bfa345262a70c7540af' );

define( 'WPE_CLUSTER_ID', '405353' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_SFTP_ENDPOINT', '34.139.4.61' );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'thefountainspa.com', 1 => 'www.thefountainspa.com', 2 => 'thefountainspa.wpengine.com', 3 => 'thefountainspa.wpenginepowered.com', );

$wpe_varnish_servers=array ( 0 => '127.0.0.1', );

$wpe_special_ips=array ( 0 => '34.75.155.76', 1 => 'pod-405353-utility.pod-405353.svc.cluster.local', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );

/*MEMCACHED_ENV_START*/ if (isset($_ENV['WPE_CACHE_HOST'])) $memcached_servers=array ( 'default' =>  array ( 0 => $_ENV['WPE_CACHE_HOST'], ), ); /*MEMCACHED_ENV_END*/

define( 'WP_CACHE', TRUE );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings




define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );
// @ini_set( 'display_errors', 0 );

# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');

