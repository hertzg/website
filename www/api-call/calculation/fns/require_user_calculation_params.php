<?php

function require_user_calculation_params ($mysqli,
    $user, &$expression, &$title, &$tags, &$tag_names,
    &$value, &$error, &$error_char, $exclude_id = null) {

    include_once __DIR__.'/require_calculation_params.php';
    require_calculation_params($expression, $title,
        $tags, $tag_names, $value, $error, $error_char);

}
