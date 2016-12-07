<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.11.16
 * Time: 21:05
 */
use Tender\User\UserPermission;

$app->get('/register', $guest(), function () use ($app) {
    $app->render('auth/register.php');
})->name('register');

$app->post('/register', $guest(), function () use ($app) {
    $request = $app->request;

    $email = $request->post('email');
    $username = $request->post('username');
    $password = $request->post('password');
    $passwordConfirm = $request->post('password_confirm');
    $company = $request->post('company_name');
    $juroAddress = $request->post('juro_address');
    $postAddress = $request->post('post_address');
    $firstName = $request->post('first_name');
    $lastName = $request->post('last_name');
    $office = $request->post('office');
    $phoneNumber = $request->post('phone_number');
    $egrpou = $request->post('egrpou');
    $iso9001 = $request->post('iso9001');
    $uniqIdentifier = $app->randomlib->generateInt(000000, 999999);

    $v = $app->validation;

    $v->validate([
        'email' => [$email, 'required|email|uniqueEmail'],
        'username' => [$username, 'required|alnumDash|max(20)|uniqueUsername'],
        'password' => [$password, 'required|min(6)'],
        'password_confirm' => [$passwordConfirm, 'required|matches(password)'],
        'company' => [$company, 'required|min(2)|max(100)'],
        'juro_address' => [$juroAddress, 'required|min(2)|max(100)'],
        'post_address' => [$postAddress, 'required|min(2)|max(100)'],
        'first_name' => [$firstName, 'required|min(2)|max(100)'],
        'last_name' => [$lastName, 'required|min(2)|max(100)'],
        'office' => [$office, 'required|min(2)|max(100)'],
        'phone_number' => [$phoneNumber, 'required|min(2)|max(100)'],
        'egrpou' => [$egrpou, 'min(2)|max(100)'],
    ]);

    if ($v->passes()) {

        $identifier = $app->randomlib->generateString(128);

        if ($app->user->where('uniq_identifier', $uniqIdentifier)->count()) {
            $uniqIdentifier = $app->randomlib->generateInt(000000, 999999);
        }

        $user = $app->user->create([
            'uniq_identifier' => $uniqIdentifier,
            'email' => $email,
            'username' => $username,
            'password' => $app->hash->password($password),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'active' => false,
            'active_hash' => $app->hash->hash($identifier),
            'company' => $company,
            'juro_address' => $juroAddress,
            'post_address' => $postAddress,
            'person_office' => $office,
            'phone_number' => $phoneNumber,
            'egrpou' => $egrpou,
            'iso9001' => $iso9001
        ]);


        $user->permission()->create(UserPermission::$default);

        $app->mail->send('email/auth/Registered.php', ['user' => $user, 'identifier' => $identifier], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Благодарим за регистрацию.');
        });

        $app->flash('success', 'Ваш аккаунт успешно зарегистрирован. На Вашу почту отправлено письмо для активации аккаунта.');
        return $app->response->redirect($app->urlFor('home'));
    } else {
        $app->render('auth/register.php', [
            'errors' => $v->errors(),
            'request' => $request
        ]);
    }

})->name('register.post');