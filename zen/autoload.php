<?php
require_once('_common.php');
require_once('vendor/autoload.php');

define('__ZEN__', __DIR__ );

define('ZEN_URL', G5_URL . '/zen');
define('ZEN_ASSET_URL', ZEN_URL . '/assets');
define('ZEN_JS_URL', ZEN_ASSET_URL . '/js');
define('ZNE_CSS_URL', ZEN_ASSET_URL . '/css');

define('G5_SP_ADMIN_DIR', 'admsp');
define('G5_ST_ADMIN_DIR', 'admst');
define('G5_FR_ADMIN_DIR', 'admfr');

define('G5_SP_ADMIN_PATH', G5_PATH . DIRECTORY_SEPARATOR . G5_SP_ADMIN_DIR);
define('G5_ST_ADMIN_PATH', G5_PATH . DIRECTORY_SEPARATOR . G5_ST_ADMIN_DIR);
define('G5_FR_ADMIN_PATH', G5_PATH . DIRECTORY_SEPARATOR . G5_FR_ADMIN_DIR);

define('G5_SP_ADMIN_URL', G5_URL . DIRECTORY_SEPARATOR . G5_SP_ADMIN_DIR);
define('G5_ST_ADMIN_URL', G5_URL . DIRECTORY_SEPARATOR . G5_ST_ADMIN_DIR);
define('G5_FR_ADMIN_URL', G5_URL . DIRECTORY_SEPARATOR . G5_FR_ADMIN_DIR);


use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->setAsGlobal();
$capsule->addConnection(array(
    'driver'    => 'mysql',
    'host'      => G5_MYSQL_HOST,
    'database'  => G5_MYSQL_DB,
    'username'  => G5_MYSQL_USER,
    'password'  => G5_MYSQL_PASSWORD,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => G5_TABLE_PREFIX
));
$capsule->bootEloquent();


use \Illuminate\Container\Container as Container;
use \Illuminate\Support\Facades\Facade as Facade;

/**
 * Setup a new app instance container
 *
 * @var Illuminate\Container\Container
 */
$app = new Container();
$app->singleton('app', 'Illuminate\Container\Container');

/**
 * Set $app as FacadeApplication handler
 */
Facade::setFacadeApplication($app);

use Coolpraz\PhpBlade\PhpBlade;

$views = __DIR__ . '/resource/views';
$cache = __DIR__ . '/resource/cache';

$blade = new PhpBlade($views, $cache);

if( ! function_exists('blade')) {
    function blade(){
        global $blade;
        return $blade->view();
    }
}
// echo $blade->view()->make('meta', ['name' => 'John Doe']);

if( ! function_exists('dd') ) {
    function dd(){
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');

        var_dump(func_get_args());
        // debug_zval_dump(func_get_args());
        // debug_backtrace();
        // xdebug_print_function_stack();
        debug_print_backtrace();
        die();
    }
}
