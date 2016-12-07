<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.11.16
 * Time: 15:41
 */
$app->get('/account/profile', $authenticated(), function () use ($app) {
    $app->render('account/profile.php');
})->name('account.profile');

$app->post('/account/profile', $authenticated(), function () use ($app) {

    $request = $app->request;

    $email = $request->post('email');
    $firstName = $request->post('first_name');
    $lastName = $request->post('last_name');
    $company = $request->post('company');
    $juroAddress = $request->post('juro_address');
    $postAddress = $request->post('post_address');
    $office = $request->post('office');
    $phoneNumber = $request->post('phone_number');
    $egrpou = $request->post('egrpou');
    $iso9001 = $request->post('iso9001');

    $v = $app->validation;

    $v->validate([
        'email' => [$email, 'required|email|uniqueEmail'],
        'first_name' => [$firstName, 'alpha|required|min(2)|max(50)'],
        'last_name' => [$lastName, 'alpha|required|min(2)|max(50)'],
        'company' => [$company, 'required|min(2)|max(100)'],
        'juro_address' => [$juroAddress, 'required|min(2)|max(100)'],
        'post_address' => [$postAddress, 'required|min(2)|max(100)'],
        'office' => [$office, 'required|min(2)|max(100)'],
        'phone_number' => [$phoneNumber, 'required|min(2)|max(100)'],
        'egrpou' => [$egrpou, 'min(2)|max(100)'],
        'iso9011' => [$iso9001, 'min(2)|max(100)']
    ]);

    if ($v->passes()) {
        $user = $app->auth;
        $user->update([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'company' => $company,
            'juro_address' => $juroAddress,
            'post_address' => $postAddress,
            'person_office' => $office,
            'phone_number' => $phoneNumber,
            'egrpou' => $egrpou,
            'iso9001' => $iso9001
        ]);

        $app->flash('success', 'Данные успешно обновлены');
        return $app->response->redirect($app->urlFor('account.profile'));
    }

    $app->render('account/profile.php', [
        'errors' => $v->errors(),
        'request' => $request
    ]);

})->name('account.profile.post');