<?php

function request_calculation_params ($mysqli,
    $user, &$errors, &$focus, $exclude_id = null) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Users/Calculations/get.php";
    $value_of = function ($id) use ($mysqli, $user, $exclude_id) {
        if ($id == $exclude_id) return;
        $calculation = Users\Calculations\get($mysqli, $user, $id);
        if ($calculation) return $calculation->value;
    };

    include_once "$fnsDir/Calculations/request.php";
    list($expression, $title, $tags,
        $value, $error, $error_char) = Calculations\request($value_of);

    if ($expression === '') {
        $errors[] = 'Enter expression.';
        $focus = 'expression';
    } elseif ($value === null) {
        $errors[] = 'The expression is invalid.';
        $errors[] = "$error At char ".($error_char + 1).'.';
        $focus = 'expression';
    }

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors, $focus);

    return [$expression, $title, $tags,
        $tag_names, $value, $error, $error_char];

}
