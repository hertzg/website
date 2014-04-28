<?php

function note_method_page ($methodName, $params = []) {

    include_once __DIR__.'/get_methods.php';
    $description = get_methods()[$methodName];

    include_once '../../fns/method_page.php';
    method_page('Note', 'note', $methodName, $description, $params);

}
