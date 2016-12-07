<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.16
 * Time: 17:57
 */

$app->get('/logout', function () use ($app) {
    unset($_SESSION[$app->config->get('auth.session')]);
    if ($app->getCookie($app->config->get('auth.remember'))) {
        $app->auth->removeRememberCredentials();
        $app->deleteCookie($app->config->get('auth.remember'));
    }
    $app->flash('success', 'Вы успешно вышли из системы');
    return $app->response->redirect($app->urlFor('home'));

})->name('logout');