<?php
define('DIR_VENDOR_APP', __DIR__.'/vendor/');
define('DIR_BASE_APP', __DIR__.'/../../vendor/');


if (file_exists(DIR_BASE_APP . 'autoload.php')) {
    require_once(DIR_BASE_APP . 'autoload.php');
}


if (file_exists(DIR_VENDOR_APP . 'autoload.php')) {
    require_once(DIR_VENDOR_APP . 'autoload.php');
}

try {
    (new Dotenv\Dotenv(__DIR__))->load();
} catch (\Exception $ex) {
    echo $ex->getMessage();
    exit;
}

include __DIR__."/config/db_init.php";

define('DEBUG_ENABLED',1);

//harpya\ufw\Application::getInstance()->addProp(harpya\ufw\Application::CMP_DEBUG, 1);