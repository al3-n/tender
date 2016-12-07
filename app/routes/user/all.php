<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.16
 * Time: 20:02
 */
$app->get('/users', function () use ($app) {
    $users = $app->user->where('active', true)->get();
    $app->render('user/all.php', [
        'users' => $users
    ]);
})->name('user.all');