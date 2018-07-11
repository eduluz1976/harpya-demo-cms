<?php

$dbName = getenv('DB_NAME');
$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASS');
$dbPort = getenv('DB_PORT');
$dbType = getenv('DB_TYPE');

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection([
  'driver' => $dbType,
  'host' => $dbHost,
  'database' => $dbName,
  'username' => $dbUser,
  'password' => $dbPass,
  'port' => $dbPort,
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix' => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$dsn = "$dbType:dbname=$dbName";
if ($dbHost) {
    $dsn.=";host=$dbHost";
} else {
    $dsn.=";host=localhost";
}

if ($dbPort) {
    $dsn.=";port=$dbPort";
}

$dao = new \harpya\ufw\DAO($dsn, $dbUser, $dbPass);

\harpya\ufw\Application::getInstance()->addProp(\harpya\ufw\Application::CMP_DB, $dao);


