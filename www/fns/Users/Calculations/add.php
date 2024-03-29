<?php

namespace Users\Calculations;

function add ($mysqli, $id_users, $expression, $title,
    $tags, $tag_names, $value, $error, $error_char,
    $resolved_expression, $depends, $insertApiKey = null) {

    $fnsDir = __DIR__.'/../..';
    $insert_time = $update_time = time();

    include_once "$fnsDir/Calculations/add.php";
    $id = \Calculations\add($mysqli, $id_users, $expression, $title, $tags,
        $tag_names, $value, $error, $error_char, $resolved_expression,
        count($depends), $insert_time, $update_time, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/CalculationTags/add.php";
        \CalculationTags\add($mysqli, $id_users, $id, $tag_names,
            $expression, $title, $value, $insert_time, $update_time);
    }

    if ($depends) {
        include_once "$fnsDir/CalculationDepends/add.php";
        \CalculationDepends\add($mysqli, $id_users, $id, $depends);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
