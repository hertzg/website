<?php

function render_schedules ($user, $mysqli, &$items) {

    if (!$user->show_schedules) return;

    $fnsPageDir = __DIR__.'/../../fns/Page';

    include_once __DIR__.'/check_schedule_check_day.php';
    check_schedule_check_day($mysqli, $user);
    $today = $user->num_schedules_today;
    $tomorrow = $user->num_schedules_tomorrow;

    $title = 'Schedules';
    $href = '../schedules/';
    $icon = 'schedules';

    if ($today || $tomorrow) {

        $descriptionItems = [];
        if ($today) $descriptionItems[] = "$today today.";
        if ($tomorrow) $descriptionItems[] = "$tomorrow tomorrow.";
        $description = join(' ', $descriptionItems);

        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        $link = Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon);

    } else {
        include_once "$fnsPageDir/imageArrowLink.php";
        $link = Page\imageArrowLink($title, $href, $icon);
    }

    $items['schedules'] = $link;

}
