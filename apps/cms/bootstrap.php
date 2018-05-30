<?php
define('DIR_VENDOR_APP', __DIR__.'/vendor/');

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