<?php

function received_note_method_page ($methodName,
    array $params, array $errors) {

    include_once __DIR__.'/../../../fns/note/received/get_methods.php';
    $description = note\received\get_methods()[$methodName];

    include_once __DIR__.'/../../../fns/submethod_page.php';
    submethod_page('note', 'Received', 'received',
        $methodName, $description, $params, $errors);

}
