<?php

function request_calculation_params (&$errors, &$focus) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Calculations/request.php";
    list($expression, $title, $tags,
        $value, $error, $error_char) = Calculations\request();

    if ($expression === '') {
        $errors[] = 'Enter expression.';
        $focus = 'expression';
    } elseif ($value === null) {
        $errors[] = 'The expression is invalid.';
        $errors[] = "$error At char $error_char.";
        $focus = 'expression';
    }

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors, $focus);

    return [$expression, $title, $tags,
        $tag_names, $value, $error, $error_char];

}
