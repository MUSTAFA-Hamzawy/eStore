<?php

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

// some needed files
define("HEADER", VIEWS . DIRECTORY_SEPARATOR . "MainFiles" . DIRECTORY_SEPARATOR . "header.php");
define("SIDEBAR", VIEWS . DIRECTORY_SEPARATOR . "MainFiles" . DIRECTORY_SEPARATOR . "sidebar.php");
define("USER_MESSAGES", VIEWS . DIRECTORY_SEPARATOR . "MainFiles" . DIRECTORY_SEPARATOR . "messagesToUserScript.php");
define("FORM_VALIDATION", VIEWS . DIRECTORY_SEPARATOR . "MainFiles" . DIRECTORY_SEPARATOR . "formValidation.php");
define("RESUBMISSION_PREVENT", VIEWS . DIRECTORY_SEPARATOR . "MainFiles" . DIRECTORY_SEPARATOR . "refreshSubmissionPrevent.php");
define("SHOW_USER_MESSAGES", VIEWS . DIRECTORY_SEPARATOR . "MainFiles" . DIRECTORY_SEPARATOR . "userMessegesPHP.php");


// database info
define("DATABASE_NAME", 'store');
define("PASSWORD", '');
define("USER_NAME", 'root');
define("HOST_NAME", 'localhost');
define("PORT", 3306);

// Session configurations
define('SESSION_NAME', "MVC_APP");                      // Set session name : string
define('SESSION_MAX_LIFE_TIME', 0);
define('SESSION_PATH', '/');
define('SESSIONS_DIR', APP . DIRECTORY_SEPARATOR . "sessions");      // The path of sessions dir
define('SESSIONS_CIPHER_METHOD', 'aes-128-ctr');

// Uploads
define("UPLOADS", PUBLIC_DIR . DIRECTORY_SEPARATOR . "uploads");
define("IMAGES_UPLOADS", UPLOADS . DIRECTORY_SEPARATOR . "images");
define("DOCS_UPLOADS", UPLOADS . DIRECTORY_SEPARATOR . "Docs");
define("GET_IMAGES_LINK", "http://localhost/pages/eStore/public/uploads/images/");
