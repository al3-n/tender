<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.11.16
 * Time: 10:24
 */
$app->get('/account/change_password', $authenticated, function () use ($app) {
   $app->render('auth/password/change.php');
})->name('password.change');

$app->post('/account/change_password', $authenticated, function () use ($app) {
    $request = $app->request;

    $oldPassword = $app->request->post('old_password');
    $password = $app->request->post('password');
    $passwordConfirm = $app->request->post('password_confirm');

    $v = $app->validation;

    $v->validate([
        'old_password' => [$oldPassword, 'required|matchesCurrentPassword'],
        'password' => [$password, 'required|min(6)'],
        'password_confirm' => [$passwordConfirm, 'required|matches(password)']
    ]);

    if ($v->passes()) {

        $user = $app->auth;

        $user->update([
            'password' => $app->hash->password($password)
        ]);

        $app->mail->send('email/auth/password/change.php', [], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Смена пароля на тендерной площадке AIK-EKO');
        });

        $app->flash('success', 'Пароль успешно изменен');
        return $app->response->redirect($app->urlFor('password.change'));
    }

    $app->render('auth/password/change.php', [
        'errors' => $v->errors()
    ]);

})->name('password.change.post');