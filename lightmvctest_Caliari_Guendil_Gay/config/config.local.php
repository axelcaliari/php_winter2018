<?php

$baseConfig['appName'] = "Webedia Shop";

/*$baseConfig['doctrine']['DBAL']['dbm1'] = [
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'user'     => 'root',
    'password' => 'vagrant',
    'dbname'   => 'php1',
];*/

$baseConfig['doctrine']['ORM']['em1'] = [
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'user'     => 'lightmvcuser',
    'password' => 'testpass',
    'dbname'   => 'lightmvctestdb',
];