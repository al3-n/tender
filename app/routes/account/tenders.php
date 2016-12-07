<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.11.16
 * Time: 15:16
 */
$app->get('/account/tenders', $authenticated(), function () use ($app) {

    $tenders = $app->tender->where('finished', 1)->where('winner', $app->auth->uniq_identifier)->get();
    $tender = $app->tender->where('finished', 0)->where('tender_number', $app->auth->curent_tender)->first();
    $active_tender = "";
    $place = 0;
    if ($tender) {

        $userCheck = $app->register
            ->where('uniq_identifier', $app->auth->uniq_identifier)
            ->where('registered_tender', $tender->tender_number)
            ->where('finished', 0)
            ->first();


        if (isset($userCheck->registered_tender)) {
            $active_tender = $app->tender->where('tender_number', $userCheck->registered_tender)->get();
        }

        $place = $app->register->placement($app->auth->uniq_identifier, $app->auth->curent_tender);

    }

    $demo = $app->register
        ->where('finished', 1)
        ->where('uniq_identifier', $app->auth->uniq_identifier)->get();

    $data = array();
    $status = array();
    foreach ($demo as $item) {
        $tenderData = $app->tender->where('tender_number', $item->registered_tender)->first();
        array_push($data, $tenderData);
        $status = $item->status;
    }

    $app->render('account/tenders.php', [
            'status' => $status,
            'all_tenders' => $data,
            'active_tender' => $active_tender,
            'place' => $place
        ]
    );

})->setName('account.tenders');

$app->post('/account/tenders', $authenticated(), function () use ($app) {
    $request = $app->request;

    $price = $request->post('price');

    $v = $app->validation;

    $v->validate([
        'curent_price' => [$price, 'required|alnum|min(3)']
    ]);

    if ($v->passes() && $price <= $app->auth->curent_price) {
        $app->register->where('uniq_identifier', $app->auth->uniq_identifier)->update([
            'curent_price' => $price
        ]);
        $app->user->where('uniq_identifier', $app->auth->uniq_identifier)->update([
            'curent_price' => $price
        ]);

        $app->flash('success', 'Цена обновлена');
        $app->response->redirect($app->urlFor('account.tenders'));

    } else {
        $app->flash('danger', 'Цена не может быть выше предыдущей');
        $app->response->redirect($app->urlFor('account.tenders'));
    }

    $app->render('account/tenders.php', [
        'errors' => $v->errors(),
        'request' => $request
    ]);

})->setName('account.tenders.post');