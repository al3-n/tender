<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22.11.16
 * Time: 14:06
 */

$app->get('/activate', $guest(), function () use ($app) {
    $request = $app->request;
    $email = $request->get('email');
    $identifier = $request->get('identifier');

    $hashedIdentifier = $app->hash->hash($identifier);

    $user = $app->user->where('email', $email)
        ->where('active', false)
        ->first();

    if (!$user || !$app->hash->hashCheck($user->active_hash, $hashedIdentifier)) {
        $app->flash('danger', 'Возникла проблема при активации аккаунта');
        return $app->response->redirect($app->urlFor('home'));
    } else {
        $user->activateAccount();
        $app->flash('success', 'Ваш аккаунт успешно активирован');
        return $app->response->redirect($app->urlFor('home'));
    }
})->name('activate');