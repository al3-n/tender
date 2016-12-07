<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02.12.16
 * Time: 10:29
 */

$app->get('/tenders/tender-view/:tender', function ($tender) use ($app) {

    $tender = $app->tender->where('tender_number', $tender)->first();
    $error = "";

    if ($app->auth) {

        $tenderCheck = $app->register
            ->where('registered_tender', $tender->tender_number)
            ->where('uniq_identifier', $app->auth->uniq_identifier)
            ->where('finished', 0)
            ->count();
        $userCheck = $app->user
            ->where('curent_tender', $tender->tender_number)
            ->where('uniq_identifier', $app->auth->uniq_identifier)
            ->count();
        if ($userCheck == 1 && $tenderCheck == 1) {
            $error .= "Вы уже зарегистрировались на этом тендере. ";
        } elseif ($userCheck == 1 || !empty($app->auth->curent_tender)) {
            $error .= "Можно участвовать только в одном тендере. Дождитесь заверешения уже заявленного тендера.";
        } else {

        }

    }
    $app->render('tenders/tender-view.php', [
        'tender' => $tender,
        'error' => $error
    ]);


})->setName('tender-view');

$app->post('/tenders/tender-view/:tender', $authenticated(), function ($tender) use ($app) {
    $tenderData = $app->tender->where('tender_number', $tender)->first();
    $tender = $app->tender->where('tender_number', $tender)->first();

    $app->render('tenders/tender-view.php', [
        'tender' => $tender
    ]);
    $request = $app->request;

    $fileContent = $request->post('file_contents');

    $tender = $request->post('tender');
    $price = $request->post('summ');

    $storage = new \Upload\Storage\FileSystem(INC_ROOT . "/public/clients/");
    $url = $app->config->get('app.url') . "/clients/";

    $file = new \Upload\File('file_contents', $storage);

    $name = $app->randomlib->generateInt(0000, 9999) . '-' . $app->auth->company . '-' . $file->getName();

    $file->setName($name);

    $file->addValidations([
        new \Upload\Validation\Mimetype('application/zip'),
        new \Upload\Validation\Size('15M')
    ]);

    try {
        $file->upload();
        $name = $name . ".zip";
        $fileContent = "$url$name";

        $v = $app->validation;

        $v->validate([
            'summ' => [$price, 'required|alnum|min(3)']
        ]);

        if ($v->passes()) {

            $app->register->create([
                'uniq_identifier' => $app->auth->uniq_identifier,
                'registered_tender' => $tender,
                'company' => $app->auth->company,
                'curent_price' => $price,
                'file_contents' => $fileContent
            ]);

            $app->user->where('uniq_identifier', $app->auth->uniq_identifier)->update([
                'curent_tender' => $tender,
                'curent_price' => $price
            ]);


            $count_mem = $app->tender->where('tender_number', $tender)->first();
            $app->tender->where('tender_number', $tender)->update([
                'count_members' => $count_mem->count_members + 1
            ]);

            $user = $app->user->where('uniq_identifier', $app->auth->uniq_identifier)->first();
            $app->mail->send('email/tenders/register.php', ['user' => $user, 'tender' => $tenderData], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Заявка на участие в тендере');
            });

            $app->flash('success', 'Документы успешно загружены');
            $app->response->redirect($app->urlFor('account.tenders'));
        } else {
            $app->render('tenders/tender-view.php', [
                'errors' => $v->errors(),
                'request' => $request
            ]);
        }


    } catch (\Exception $e) {
        $errors = $file->getErrors();
        $err = '';
        foreach ($errors as $error) {
            $err .= $error . "\n";
        }
        $app->render('tenders/tender-view.php', [
            'file_error' => $err,
            'request' => $request
        ]);
    }


})->setName('tender-view.post');