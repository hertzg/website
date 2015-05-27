<?php

namespace HomePage;

function renderSchedules ($user, $mysqli, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_schedule) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-schedule'] = \Page\imageArrowLink(
            'New Schedule', '../schedules/new/', 'create-schedule');
    }

    if (!$user->show_schedules) return;

    include_once __DIR__.'/checkScheduleCheckDay.php';
    checkScheduleCheckDay($mysqli, $user);
    $today = $user->num_schedules_today;
    $tomorrow = $user->num_schedules_tomorrow;

    $title = 'Schedules';
    $href = '../schedules/';
    $icon = 'schedules';
    $options = ['id' => 'schedules'];

    if ($today || $tomorrow) {

        $descriptions = [];
        if ($today) $descriptions[] = "$today today.";
        if ($tomorrow) $descriptions[] = "$tomorrow tomorrow.";
        $description = join(' ', $descriptions);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['schedules'] = $link;

}
