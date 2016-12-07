<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.11.16
 * Time: 14:46
 */
$app->get('/', function () use ($app) {

    $tenders = $app->tender->where('finished', 0)->get();
    $app->render('home.php', ['tenders' => $tenders]);

})->name('home');