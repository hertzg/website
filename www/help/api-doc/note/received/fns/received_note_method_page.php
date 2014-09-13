<?php

function received_note_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/note/received/get_methods.php";
    $description = note\received\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('note', 'Received', 'received',
        $methodName, $description, $params, $errors);

}
