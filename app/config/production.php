<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14.11.16
 * Time: 11:51
 */

return [
    'app' => [
        'url' => 'http://93.127.113.176:8888',
        'hash' => [
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10
        ]
    ],
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'name' => 'tender',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => 'ta_'
    ],
    'auth' => [
        'session' => 'user_id',
        'remember' => 'user_rem',
    ],
    'mail' => [
        'from' => 'tender@aik-eko.com',
        'smtp_auth' => true,
        'smtp_secure' => 'tls',
        'host' => 'smtp.gmail.com',
        'username' => 'v3ktor221@gmail.com',
        'password' => '553909163f',
        'port' => 587,
        'html' => true
    ],
    'twig' => [
        'debug' => true
    ],
    'csrf' => [
        'key' => 'csrf_token'
    ]
];