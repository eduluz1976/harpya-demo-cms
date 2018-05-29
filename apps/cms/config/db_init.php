<?php

$x = new \harpya\ufw\Application();


$dbName = getenv('DB_NAME');
$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASS');
$dbPort = getenv('DB_PORT');


$strConn = "pgsql:dbname=$dbName;host=$dbHost";
if ($dbPort) {
    $strConn .= ";port=$dbPort";
}

$db = new \harpya\ufw\DAO($strConn, $dbUser, $dbPass);

\harpya\ufw\Application::getInstance()->addProp(\harpya\ufw\Application::CMP_DB, $db);
