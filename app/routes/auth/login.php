<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21.11.16
 * Time: 13:16
 */

use Carbon\Carbon;

$app->get('/login', $guest(), function () use ($app) {
    $app->render('auth/login.php', [
        'referer' => $_SERVER['HTTP_REFERER']
    ]);
})->name('login');

$app->post('/login', $guest(), function () use ($app) {
    $request = $app->request;

    $referer = $request->post('referer');
    $identifier = $request->post('identifier');
    $password = $request->post('password');
    $remember = $request->post('remember');

    $v = $app->validation;

    $v->validate([
        'identifier' => [$identifier, 'required'],
        'password' => [$password, 'required']
    ]);

    if ($v->passes()) {

        $user = $app->user
            ->where('username', $identifier)
            ->orWhere('email', $identifier)
            ->where('active', true)
            ->first();


        if ($user && $app->hash->passwordCheck($password, $user->password)) {

            if (!$app->user->where('active', true)->first()) {

                $app->flash('global', 'Для входа систему необходимо активировать аккаунт');
                return $app->response->redirect($app->urlFor('login'));

            } else {

                $_SESSION[$app->config->get('auth.session')] = $user->id;

                if ($remember === "on") {

                    $rememberIdentifier = $app->randomlib->generateString(128);
                    $rememberToken = $app->randomlib->generateString(128);

                    $user->updateRememberCredentials(
                        $rememberIdentifier,
                        $app->hash->hash($rememberToken)
                    );

                    $app->setCookie(
                        $app->config->get('auth.remember'),
                        "{$rememberIdentifier}___{$rememberToken}",
                        Carbon::parse('+1 week')->timestamp
                    );
                }
                $uri = $referer;
                $uri = explode('/', $uri);
                if (in_array('tender-view', $uri)) {
                    $app->flash('success', 'Вы успешно вошли в систему');
                    return $app->response->redirect($referer);

                } else {
                    $app->flash('success', 'Вы успешно вошли в систему');
                    return $app->response->redirect($app->urlFor('home'));

                }

            }
        } else {
            $app->flash('danger', 'Не удалось пройти авторизацию');
            return $app->response->redirect($app->urlFor('login'));

        }
    }

    $app->render('auth/login.php', [
        'errors' => $v->errors(),
        'request' => $request
    ]);

})->
name('login.post');