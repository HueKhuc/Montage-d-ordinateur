<?php spl_autoload_register(function ($class) {
    require_once './classes/' . $class . '.php';
});
spl_autoload_register(function ($class) {
    require_once './classes/Factory/' . $class . '.php';
});
require_once 'includes/function.php';
require_once 'includes/config.inc.php';