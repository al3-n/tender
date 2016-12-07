<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.16
 * Time: 19:28
 */

$app->get('/u/:uniq_identifier', $admin(), function ($uniq_identifier) use ($app) {
    $user = $app->user->where('uniq_identifier', $uniq_identifier)->first();
    if (!$user) {
        $app->notFound();
    }

    $app->render('user/profile.php', [
        'user' => $user
    ]);
})->name('user.profile');