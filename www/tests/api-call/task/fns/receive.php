<?php

function receive () {

    include_once __DIR__.'/../../fns/get_sender_engine.php';
    $engine = get_sender_engine();

    $engine->request('task/send', [
        'text' => 'sample text',
        'top_priority' => true,
        'tags' => 'tag1 tag2',
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();

}
