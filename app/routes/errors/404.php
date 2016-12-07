<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.16
 * Time: 22:07
 */
$app->notFound(function () use ($app){
   $app->render('errors/404.php');
});