<?php

function receive (&$numRequests) {

    include_once __DIR__.'/../../fns/get_sender_engine.php';
    $engine = get_sender_engine();

    $engine->request('contact/send', [
        'full_name' => 'sample full_name',
        'alias' => 'sample alias',
        'address' => 'sample address',
        'email' => 'sample email',
        'phone1' => 'sample phone1',
        'phone2' => 'sample phone2',
        'birthday_time' => 0,
        'username' => 'sample username',
        'tags' => 'tag1 tag2',
        'favorite' => true,
        'receiver_username' => 'aimnadze',
    ]);
    $engine->expectSuccess();

    $numRequests += $engine->numRequests;

}
