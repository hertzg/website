<?php

function receive (&$numRequests) {

    $tempName = sys_get_temp_dir().'/test_'.rand();
    file_put_contents($tempName, 'test content '.rand());
    $file = new CURLFile($tempName);

    include_once __DIR__.'/../../fns/get_sender_engine.php';
    $engine = get_sender_engine();

    $engine->request('file/send', [
        'name' => 'sample name',
        'file' => $file,
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();

    unlink($tempName);

    $numRequests += $engine->numRequests;

}
