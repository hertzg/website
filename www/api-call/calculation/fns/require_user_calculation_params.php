<?php

function require_user_calculation_params ($mysqli, $user,
    &$expression, &$title, &$tags, &$tag_names, &$value, &$error,
    &$error_char, &$referenced_calculations, $exclude_id = null) {

    $fnsDir = __DIR__.'/../../../fns';

    $referenced_calculations = [];

    include_once "$fnsDir/Users/Calculations/get.php";
    $value_of = function ($id) use ($mysqli,
        $user, $exclude_id, &$referenced_calculations) {

        if ($id == $exclude_id) return;

        $calculation = Users\Calculations\get($mysqli, $user, $id);
        if (!$calculation) return;

        $referenced_calculations[$calculation->id] = $calculation;
        return $calculation->value;

    };

    include_once __DIR__.'/require_calculation_params.php';
    require_calculation_params($expression, $title, $tags,
        $tag_names, $value, $error, $error_char, $value_of);

}
