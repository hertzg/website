<?php

function require_calculation_params ($mysqli, $user,
    &$expression, &$title, &$tags, &$tag_names, &$value, &$error,
    &$error_char, &$resolved_expression, &$depends, $exclude_id = null) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/user_calculation_resolver.php";
    $value_of = user_calculation_resolver(
        $mysqli, $user, $depends, $exclude_id);

    include_once "$fnsDir/Calculations/request.php";
    list($expression, $title, $tags, $value, $error,
        $error_char, $resolved_expression) = Calculations\request($value_of);

    if ($expression === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_EXPRESSION"');
    } elseif ($value === null) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"INVALID_EXPRESSION"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

}
