<?php

namespace Users\Calculations;

function addDeleted ($mysqli, $id_users, $data) {

    $id = $data->id;
    $expression = $data->expression;
    $title = $data->title;
    $tags = $data->tags;
    $insert_time = $data->insert_time;
    $update_time = $data->update_time;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Calculations/addDeleted.php";
    \Calculations\addDeleted($mysqli, $id, $id_users, $expression, $title,
        $tags, $tag_names, $insert_time, $update_time, $data->revision);

    if ($tag_names) {
        include_once "$fnsDir/CalculationTags/add.php";
        \CalculationTags\add($mysqli, $id_users, $id,
            $tag_names, $expression, $title, $insert_time, $update_time);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
