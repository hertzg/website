<?php

namespace Calculations;

function request ($value_of = null) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($expression, $title, $tags) = request_strings(
        'expression', 'title', 'tags');

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/str_collapse_spaces.php";
    $expression = str_collapse_spaces($expression);
    $expression = mb_substr($expression, 0, $maxLengths['expression'], 'UTF-8');

    $title = str_collapse_spaces($title);
    $title = mb_substr($title, 0, $maxLengths['title'], 'UTF-8');

    $tags = str_collapse_spaces($tags);
    $tags = mb_substr($tags, 0, $maxLengths['tags'], 'UTF-8');

    include_once "$fnsDir/evaluate.php";
    $value = evaluate($expression, $error,
        $error_char, $pretty_expression, $value_of);

    if ($value === false) $value = null;
    else $expression = $pretty_expression;

    return [$expression, $title, $tags, $value, $error, $error_char];

}
