<?php

namespace ViewPage;

function renderSchedule ($schedule, $user, &$items) {

    $fnsDir = __DIR__.'/../../../fns';
    $interval = $schedule->interval;

    include_once "$fnsDir/Page/text.php";
    $items[] = \Page\text(htmlspecialchars($schedule->text));

    include_once "$fnsDir/Form/label.php";
    $items[] = \Form\label('Repeats in every', "$interval days");

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user, $interval, $schedule->offset);

    // FIXME move format_days_left in fnsDir
    include_once __DIR__.'/../../../schedules/fns/format_days_left.php';
    $items[] = \Form\label('Next', format_days_left($user, $days_left));

    $tags = $schedule->tags;
    if ($tags !== '') {
        $items[] = \Form\label('Tags', htmlspecialchars($tags));
    }

}
