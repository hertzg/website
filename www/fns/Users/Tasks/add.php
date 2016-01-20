<?php

namespace Users\Tasks;

function add ($mysqli, $user, $text, $deadline_time,
    $tags, $tag_names, $top_priority, $insertApiKey = null) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/maxLengths.php";
    include_once "$fnsDir/text_title.php";
    $title = text_title($text, \Tasks\maxLengths()['title']);

    $insert_time = $update_time = time();

    include_once "$fnsDir/Tasks/add.php";
    $id = \Tasks\add($mysqli, $id_users, $text, $title,
        $deadline_time, $tags, $tag_names, $top_priority,
        $insert_time, $update_time, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/TaskTags/add.php";
        \TaskTags\add($mysqli, $id_users, $id,
            $tag_names, $text, $title, $deadline_time,
            $tags, $top_priority, $insert_time, $update_time);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    include_once "$fnsDir/TaskRevisions/add.php";
    \TaskRevisions\add($mysqli, $id, $id_users, $text, $title,
        $deadline_time, $tags, $top_priority, $insert_time, 0);

    if ($deadline_time !== null) {
        include_once __DIR__.'/Deadlines/invalidateIfNeeded.php';
        Deadlines\invalidateIfNeeded($mysqli, $user, $deadline_time);
    }

    return $id;

}
