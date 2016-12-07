<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14.11.16
 * Time: 14:54
 */
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

//$capsule->addConnection([
//    'driver' => $config['db']['driver'],
//    'host' => $config['db']['host'],
//    'database' => $config['db']['name'],
//    'username' => $config['db']['username'],
//    'password' => $config['db']['password'],
//    'charset' => $config['db']['charset'],
//    'collation' => $config['db']['collation'],
//    'prefix' => $config['db']['prefix']
//]);

$capsule->addConnection([
    'driver' => $app->config->get('db.driver'),
    'host' => $app->config->get('db.host'),
    'database' => $app->config->get('db.name'),
    'username' => $app->config->get('db.username'),
    'password' => $app->config->get('db.password'),
    'charset' => $app->config->get('db.charset'),
    'collation' => $app->config->get('db.collation'),
    'prefix' => $app->config->get('db.prefix')
]);

$capsule->bootEloquent();