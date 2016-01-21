<?php

namespace Users\Schedules;

function addDeleted ($mysqli, $user, $data) {

    $id = $data->id;
    $id_users = $user->id_users;
    $text = $data->text;
    $interval = $data->interval;
    $offset = $data->offset;
    $tags = $data->tags;
    $insert_time = $data->insert_time;
    $update_time = $data->update_time;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Schedules/addDeleted.php";
    \Schedules\addDeleted($mysqli, $id, $id_users, $text, $interval, $offset,
        $tags, $tag_names, $insert_time, $update_time, $data->revision);

    include_once "$fnsDir/ScheduleRevisions/setDeletedOnSchedule.php";
    \ScheduleRevisions\setDeletedOnSchedule($mysqli, $id, false);

    if ($tag_names) {
        include_once "$fnsDir/ScheduleTags/add.php";
        \ScheduleTags\add($mysqli, $id_users, $id, $tag_names,
            $text, $interval, $offset, $insert_time, $update_time);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user, $interval, $offset);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $days_left);

}
