<?php

function receive (&$numRequests) {

    include_once __DIR__.'/../../fns/get_sender_engine.php';
    $engine = get_sender_engine();

    $engine->request('task/send', [
        'text' => 'sample text',
        'tags' => 'tag1 tag2',
        'top_priority' => true,
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();

    $numRequests += $engine->numRequests;

}
