<?php

namespace Users\Schedules;

function edit ($mysqli, $user, $schedule, $text, $interval,
    $offset, $tags, $tag_names, &$changed, $updateApiKey = null) {

    $tags_same = $schedule->tags === $tags;

    if ($schedule->text === $text &&
        (int)$schedule->interval === $interval &&
        (int)$schedule->offset === $offset && $tags_same) return;

    $changed = true;
    $id = $schedule->id;
    $fnsDir = __DIR__.'/../..';

    $update_time = time();

    include_once "$fnsDir/Schedules/edit.php";
    \Schedules\edit($mysqli, $id, $text, $interval,
        $offset, $tags, $tag_names, $update_time, $updateApiKey);

    if ($tags_same) {
        if ($tag_names) {
            include_once "$fnsDir/ScheduleTags/editSchedule.php";
            \ScheduleTags\editSchedule($mysqli, $id, $text,
                $interval, $offset, $schedule->insert_time, $update_time);
        }
    } else {

        if ($schedule->num_tags) {
            include_once "$fnsDir/ScheduleTags/deleteOnSchedule.php";
            \ScheduleTags\deleteOnSchedule($mysqli, $id);
        }

        if ($tag_names) {
            include_once "$fnsDir/ScheduleTags/add.php";
            \ScheduleTags\add($mysqli, $schedule->id_users, $id, $tag_names,
                $text, $interval, $offset, $schedule->insert_time, $update_time);
        }

    }

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user, $interval, $offset);
    $old_days_left = days_left_from_today($user,
        $schedule->interval, $schedule->offset);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $days_left);
    invalidateIfNeeded($mysqli, $user, $old_days_left);

}
