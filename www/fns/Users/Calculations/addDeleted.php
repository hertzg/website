<?php

namespace Users\Calculations;

function addDeleted ($mysqli, $user, $data) {

    $id = $data->id;
    $id_users = $user->id_users;
    $expression = $data->expression;
    $title = $data->title;
    $tags = $data->tags;
    $value = $data->value;
    $insert_time = $data->insert_time;
    $update_time = $data->update_time;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/user_calculation_resolver.php";
    $value_of = user_calculation_resolver($mysqli, $user, $depends, $id);

    include_once "$fnsDir/evaluate.php";
    $value = evaluate($expression, $error, $error_char,
        $pretty_expression, $resolved_expression, $value_of);

    if ($value === false) $value = null;
    else $expression = $pretty_expression;

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Calculations/addDeleted.php";
    \Calculations\addDeleted($mysqli, $id, $id_users,
        $expression, $title, $tags, $tag_names, $value,
        $error, $error_char, $resolved_expression, count($depends),
        $insert_time, $update_time, $data->revision);

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

}
