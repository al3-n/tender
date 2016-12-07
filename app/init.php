<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;
use RandomLib\Factory as RandomLib;

use Tender\User\User;
use Tender\Tenders\Tenders;
use Tender\Tenders\RegisterUsers;

use Tender\Validation\Validator;
use Tender\Middleware\BeforeMiddleWare;
use Tender\Middleware\CsrfMiddleware;
use Tender\Mail\Mailer;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 1);

define('INC_ROOT', dirname(__DIR__));

require INC_ROOT . '/vendor/autoload.php';

$app = new Slim([
    'mode' => file_get_contents(INC_ROOT . '/mode.php'),
    'view' => new Twig(),
    'templates.path' => INC_ROOT . "/app/views"
]);

$app->add(new BeforeMiddleWare);
$app->add(new CsrfMiddleware);

$app->configureMode($app->config('mode'), function () use ($app) {
    $app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

require 'database.php';
require 'filters.php';
require 'routes.php';

$app->auth = false;

$app->container->set('user', function () {
    return new User;
});

$app->container->set('tender', function () {
   return new Tenders;
});

$app->container->set('register', function () {
    return new RegisterUsers;
});

$app->container->singleton('hash', function () use ($app) {
    return new \Tender\Helpers\Hash($app->config);
});

$app->container->singleton('validation', function () use ($app) {
    return new Validator($app->user, $app->hash, $app->auth);
});

$app->container->singleton('mail', function () use ($app) {
    $mailer = new PHPMailer;

    $mailer->CharSet = 'utf-8';
    $mailer->setFrom('tender@aik-eko.com', 'Тендерная площадка AIK-EKO');
    $mailer->Host = $app->config->get('mail.host');
    $mailer->SMTPAuth = $app->config->get('mail.smtp_auth');
    $mailer->SMTPSecure = $app->config->get('mail.smtp_secure');
    $mailer->Port = $app->config->get('mail.port');
    $mailer->Username = $app->config->get('mail.username');
    $mailer->Password = $app->config->get('mail.password');

    $mailer->isHTML($app->config->get('mail.html'));

    return new Mailer($app->view, $mailer);
});

$app->container->singleton('randomlib', function () use ($app) {
    $factory = new RandomLib();
    return $factory->getMediumStrengthGenerator();
});

$app->get('/', function () use ($app) {
    $app->render('home.php');
});

$view = $app->view();
$view->parserOptions = [
    'debug' => $app->config->get('twig.debug')
];
$view->parserExtensions = array(
    new TwigExtension(),
);
