<?php

namespace HomePage;

function renderSchedules ($user, $mysqli, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_schedule) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['new-schedule'] = \Page\thumbnailLink(
            'New Schedule', '../schedules/new/', 'create-schedule');
    }

    if (!$user->show_schedules) return;

    include_once __DIR__.'/checkScheduleCheckDay.php';
    checkScheduleCheckDay($mysqli, $user);
    $today = $user->num_schedules_today;
    $tomorrow = $user->num_schedules_tomorrow;
    $num_received_schedules = $user->num_received_schedules;

    $title = 'Schedules';
    $href = '../schedules/';
    $icon = 'schedules';
    $options = ['id' => 'schedules'];

    if ($today || $tomorrow || $num_received_schedules) {

        $descriptions = [];
        if ($today) {
            $descriptions[] =
                "<span class=\"colorText red\">$today today.</span>";
        }
        if ($tomorrow) $descriptions[] = "$tomorrow tomorrow.";
        if ($num_received_schedules) {
            $descriptions[] = "$num_received_schedules received.";
        }
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        $link = \Page\thumbnailLinkWithDescription(
            $title, $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title, $href, $icon, $options);
    }

    $items['schedules'] = $link;

}
