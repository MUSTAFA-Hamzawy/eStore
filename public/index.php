<?php
use MVC\core\UrlHandler;
require_once "../vendor/autoload.php";

// config
define("ROOT", dirname(__DIR__));
define("APP", ROOT . DIRECTORY_SEPARATOR . "app");
define("CONTROLLERS", APP . DIRECTORY_SEPARATOR . "controllers");
define("MODELS", APP . DIRECTORY_SEPARATOR . "models");
define("VIEWS", APP . DIRECTORY_SEPARATOR . "views");
define("DOMAIN", "localhost");
define("ROOT_LINK", "http://localhost/pages/eStore/public/");

// front files paths
define("PUBLIC_DIR", ROOT . DIRECTORY_SEPARATOR . "public");
define("FRONT_ASSETS", "http://localhost/pages/eStore/public/front/");
define("BACK_ASSETS", "http://localhost/pages/eStore/public/back/");



// database info
define("DATABASE_NAME", 'store');
define("PASSWORD", '');
define("USER_NAME", 'root');
define("HOST_NAME", 'localhost');
define("PORT", 3306);

$app = new UrlHandler();