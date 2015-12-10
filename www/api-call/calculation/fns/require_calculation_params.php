<?php

function require_calculation_params ($mysqli,
    $user, &$expression, &$title, &$tags, &$tag_names,
    &$value, &$error, &$error_char, $exclude_id = null) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/user_calculation_resolver.php";
    $value_of = user_calculation_resolver($mysqli, $user, $exclude_id);

    include_once "$fnsDir/Calculations/request.php";
    list($expression, $title, $tags,
        $value, $error, $error_char) = Calculations\request($value_of);

    if ($expression === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_EXPRESSION"');
    } elseif ($value === null) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"INVALID_EXPRESSION"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

}
