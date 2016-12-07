<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 01.12.16
 * Time: 14:05
 */
$app->get('/admin/edit/:tender', $admin(), function ($tender) use ($app) {

    $users = $app->register->where('registered_tender', $tender)->get();
    $tender = $app->tender->where('tender_number', $tender)->first();

    if (!$tender) {
        $app->notFound();
    }

    $app->render('admin/edit.php', [
        'users' => $users,
        'tender' => $tender
    ]);
})->name('admin.tenders.edit');

$app->post("/admin/edit/:tender", $admin(), function ($tender) use ($app) {
    $request = $app->request;

    $tenderIdentifier = $request->post('tender_identifier');
    $purchaseOrganizer = $request->post('purchase_organizer');
    $purchaseCategory = $request->post('purchase_category');
    $productCategory = $request->post('product_category');
    $purchaseDescription = $request->post('purchase_description');
    $start_date = $request->post('start_date');
    $endDate = $request->post('end_date');
    $fileContent = $request->post('file_data');
    $winner = $request->post('winner');
    $reason = $request->post('update_reason');

    $v = $app->validation;

    $v->validate([
        'purchase_description' => [$purchaseDescription, 'required'],
        'update_reason' => [$reason, 'required']
    ]);

    if ($v->passes()) {

        if (empty($fileContent) && empty($_FILES['file_contents']['name'])) {
            $fileContent = $request->post('file_data');
        } else {
            $storage = new \Upload\Storage\FileSystem(INC_ROOT . "/public/files/");
            $url = $app->config->get('app.url') . "/files/";

            $file = new \Upload\File('file_contents', $storage);

            $name = $app->randomlib->generateInt(0000, 9999) . '-' . $file->getName();

            $file->setName($name);

            $file->addValidations([
                new \Upload\Validation\Mimetype('application/zip'),
                new \Upload\Validation\Size('30M')
            ]);

            try {
                $file->upload();
                $name = $name . ".zip";
                $fileContent = "$url$name";

                $app->flash('success', 'Тендер №' . $tenderIdentifier . ' успешно обновлен');
                $app->response->redirect($app->urlFor('admin.tender'));

            } catch (\Exception $e) {
                $errors = $file->getErrors();
                $err = '';
                foreach ($errors as $error) {
                    $err .= $error . "\n";
                }
                $app->render('admin/edit.php', [
                    'errors' => $v->errors(),
                    'file_error' => $err,
                    'request' => $request
                ]);
            }
        }

        $app->tender->where('tender_number', $tender)->update([
            'purchase_organizer' => $purchaseOrganizer,
            'purchase_category' => $purchaseCategory,
            'product_category' => $productCategory,
            'purchase_description' => $purchaseDescription,
            'start_date' => $start_date,
            'end_date' => $endDate,
            'file_contents' => $fileContent,
            'update_reason' => $reason,
        ]);

        if (!empty($winner)) {
            $price = $app->register->where('uniq_identifier', $winner)->where('registered_tender', $tender)->first();
            $app->tender->where('tender_number', $tender)->update([
                'winner' => $winner,
                'finished' => 1,
                'winner_price' => $price->curent_price
            ]);

            $app->register->where('registered_tender', $tender)->update([
                'finished' => 1,
            ]);

            $app->register->where('registered_tender', $tender)->where('uniq_identifier', $winner)->update([
                'finished' => 1,
                'status' => 1
            ]);

            $app->user->where('curent_tender', $tender)->update([
                'curent_tender' => NULL,
                'curent_price' => NULL
            ]);

            $user = $app->user->where('uniq_identifier', $winner)->first();
            $app->mail->send('email/tenders/winner.php', ['user' => $user, 'tender' => $tender], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Победа в тендере');
            });
        }

        $app->flash('success', 'Тендер №' . $tenderIdentifier . ' успешно обновлен');
        $app->response->redirect("/admin/edit/$tenderIdentifier");

    } else {
        $app->render('admin/edit.php', [
            'errors' => $v->errors(),
            'request' => $request
        ]);
    }

})->name('admin.tender.edit.post');

$app->post('/admin/edit', function () use ($app) {
    $request = $app->request;
    $v = $app->validation;
    if (!empty($request->post('userDelete'))) {
        $userID = $request->post('userId');
        $tenderID = $request->post('tenderId');
        $reasonDelete = $request->post('reasonDelete');
        $v->validate([
            'reasonDelete' => [$reasonDelete, 'required|min(5)']
        ]);

        if ($v->passes()) {
            $app->user->where('uniq_identifier', $userID)->update([
                'curent_tender' => NULL,
                'curent_price' => NULL
            ]);
            $app->register->where('uniq_identifier', $userID)->where('registered_tender', $tenderID)->where('finished', 0)->delete();

            $user = $app->user->where('uniq_identifier', $userID)->first();
            $app->mail->send('email/tenders/disqualification.php', ['reasonDelete' => $reasonDelete, 'user' => $user, 'tender' => $tenderID], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Победа в тендере');
            });

            $count_mem = $app->tender->where('tender_number', $tenderID)->first();
            $app->tender->where('tender_number', $tenderID)->update([
                'count_members' => $count_mem->count_members - 1
            ]);
        }

        $app->flash('success', 'Пользователь успешно исключен');
        $app->response->redirect("/admin/tenders");
    } else {
        $app->render('admin/edit.php', [
            'errors' => $v->errors(),
            'request' => $request
        ]);
    }
})->setName('admin.tender.edit.delete.post');