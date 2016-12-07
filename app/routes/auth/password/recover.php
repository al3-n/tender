<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.11.16
 * Time: 13:30
 */
$app->get('/recover-password', $guest(), function () use ($app) {
    $app->render('auth/password/recover.php');
})->name('password.recover');

$app->post('/recover-password', $guest(), function () use ($app) {
    $request = $app->request;

    $email = $request->post('email');

    $v = $app->validation;

    $v->validate([
        'email' => [$email, 'required|email'],
    ]);

    if ($v->passes()) {
        $user = $app->user->where('email', $email)->first();
        if (!$user) {
            $app->flash('global', 'Такого пользователя не существует');
            $app->response->redirect($app->urlFor('password.recover'));
        } else {
            $identifier = $app->randomlib->generateString(128);

            $user->update([
                'recover_hash' => $app->hash->hash($identifier),
            ]);

            $app->mail->send('email/auth/password/recover.php', ['user' => $user, 'identifier' => $identifier], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Восстановление пароля');
            });

            $app->flash('success', 'Вам отправлено письмо с инструкцией для восстановления пароля');
            return $app->response->redirect($app->urlFor('home'));
        }


    }

    $app->render('auth/password/recover.php', [
        'errors' => $v->errors(),
        'request' => $request
    ]);

})->name('password.recover.post');