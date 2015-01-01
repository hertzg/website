<?php

namespace HomePage;

function renderSchedules ($user, $mysqli, &$items) {

    if (!$user->show_schedules) return;

    $fnsDir = __DIR__.'/..';

    include_once __DIR__.'/checkScheduleCheckDay.php';
    checkScheduleCheckDay($mysqli, $user);
    $today = $user->num_schedules_today;
    $tomorrow = $user->num_schedules_tomorrow;

    $title = 'Schedules';
    $href = '../schedules/';
    $icon = 'schedules';
    $options = ['id' => 'schedules'];

    if ($today || $tomorrow) {

        $descriptionItems = [];
        if ($today) $descriptionItems[] = "$today today.";
        if ($tomorrow) $descriptionItems[] = "$tomorrow tomorrow.";
        $description = join(' ', $descriptionItems);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);

    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['schedules'] = $link;

}
