<?php

function note_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/note/get_methods.php";
    $description = note\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Note', 'note', $methodName, $description, $params, $errors);

}
