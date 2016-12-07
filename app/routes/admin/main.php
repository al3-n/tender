<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.11.16
 * Time: 20:47
 */
$app->get('/admin/main', $admin(), function () use ($app) {
    $app->render('admin/main.php', [
        'tender_number' => $app->randomlib->generateInt(0000000000, 9999999999)
    ]);
})->name('admin.tender');

$app->post('/admin/main', $admin(), function () use ($app) {

    $request = $app->request;

    $tenderIdentifier = $request->post('tender_identifier');
    $purchaseOrganizer = $request->post('purchase_organizer');
    $purchaseCategory = $request->post('purchase_category');
    $productCategory = $request->post('product_category');
    $purchaseDescription = $request->post('purchase_description');
    $start_date = $request->post('start_date');
    $endDate = $request->post('end_date');

    $v = $app->validation;

    $v->validate([
        'purchase_description' => [$purchaseDescription, 'required'],
    ]);

    if ($v->passes()) {

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
            // Success!
            $file->upload();
            $name = $name . ".zip";
            $fileContent = "$url$name";

            if ($app->tender->where('tender_number', $tenderIdentifier)->count()) {
                $tenderIdentifier = $app->randomlib->generateInt(0000000000, 9999999999);
            }

            $app->tender->create([
                'tender_number' => $tenderIdentifier,
                'purchase_organizer' => $purchaseOrganizer,
                'purchase_category' => $purchaseCategory,
                'product_category' => $productCategory,
                'purchase_description' => $purchaseDescription,
                'start_date' => $start_date,
                'end_date' => $endDate,
                'file_contents' => $fileContent
            ]);

            $app->flash('success', 'Тендер №' .$tenderIdentifier.' успешно создан');
            $app->response->redirect($app->urlFor('admin.tender'));

        } catch (\Exception $e) {
            // Fail!
            $errors = $file->getErrors();
            $err = '';
            foreach ($errors as $error) {
                $err .= $error . "\n";
            }
//            $app->flash('danger', 'Файл не подходит по заданым параметрам');
            $app->render('admin/main.php', [
                'errors' => $v->errors(),
                'file_error' => $err,
                'request' => $request
            ]);
        }

    } else {
        $app->render('admin/main.php', [
            'errors' => $v->errors(),
            'request' => $request
        ]);
    }

})->name('admin.tender.post');