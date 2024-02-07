<?php
declare(strict_types=1);

define("HOME_DIR", dirname(__DIR__) . "/");
define("HTDOCS_DIR", HOME_DIR . "htdocs/");
define("CONFIG_DIR", HOME_DIR . "config/");
define("LIBRARY_DIR", HOME_DIR . "library/");
define("TEMPLATE_DIR", HOME_DIR . "template/");

require_once(CONFIG_DIR . "config.php");
require_once(LIBRARY_DIR . "functions.php");
require_once(LIBRARY_DIR . "validate.php");
require_once(LIBRARY_DIR . "database.php");
require_once(LIBRARY_DIR . "session.php");
require_once(LIBRARY_DIR . "prefectures.php");
// require_once(LIBRARY_DIR . "login_accounts.php");
// require_once(LIBRARY_DIR . "auth.php");

Session::start();
