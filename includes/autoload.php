spl_autoload_register(function ($class) {
    require_once './classes/' . $class . '.php';
});
spl_autoload_register(function ($class) {
    require_once './classes/Factory/' . $class . '.php';
});
require_once 'fonction.php';
require_once 'config.inc.php';