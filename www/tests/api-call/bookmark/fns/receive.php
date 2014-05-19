<?php

function receive () {

    include_once __DIR__.'/../../fns/get_sender_engine.php';
    $engine = get_sender_engine();

    $engine->request('bookmark/send', [
        'url' => 'sample url',
        'title' => 'sample title',
        'tags' => 'tag1 tag2',
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();

}
