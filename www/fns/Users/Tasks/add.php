<?php

namespace Users\Tasks;

function add ($mysqli, $user, $text, $deadline_time,
    $tags, $tag_names, $top_priority, $insertApiKey = null) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/add.php";
    $id = \Tasks\add($mysqli, $id_users, $text,
        $deadline_time, $tags, $tag_names, $top_priority, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/TaskTags/add.php";
        \TaskTags\add($mysqli, $id_users, $id, $tag_names,
            $text, $deadline_time, $tags, $top_priority);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    if ($deadline_time !== null) {
        include_once __DIR__.'/Deadlines/invalidateIfNeeded.php';
        Deadlines\invalidateIfNeeded($mysqli, $user, $deadline_time);
    }

    return $id;

}
