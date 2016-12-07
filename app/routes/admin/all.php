<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 01.12.16
 * Time: 13:19
 */
$app->get('/admin/tenders', $admin(), function () use ($app) {

    $tenders = $app->tender->where('finished', 0)->get();

    $app->render('admin/all.php', [
        'tenders' => $tenders,
    ]);

})->name('admin.tenders');