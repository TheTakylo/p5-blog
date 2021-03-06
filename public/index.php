<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('CORE', ROOT . DS . 'framework');
define('TEMPLATE', ROOT . DS . 'app' . DS . 'View' . DS);
define('CONTROLLERS_DIR', ROOT . DS . 'app' . DS . 'Controller' . DS);

require_once '../vendor/autoload.php';

use Framework\Configuration\ConfigurationParser;
use Framework\Kernel;

$config = new ConfigurationParser();

$config->register('Application', 'application.php');
$config->register('Database', 'database.php');
$config->register('Routes', 'routes.php');

$application = new Kernel($config->getApplication(), $config);

$application->getResponse();
