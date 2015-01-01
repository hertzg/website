<?php

namespace SearchPage;

function renderSchedules ($schedules, &$items, $keyword, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($schedules) {

        include_once __DIR__.'/../sort_schedules.php';
        sort_schedules($user, $schedules);

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once __DIR__.'/../format_days_left.php';
        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($schedules as $schedule) {

            $id = $schedule->id;

            $title = htmlspecialchars($schedule->text);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $description = format_days_left($user, $schedule->days_left);
            $href = '../view/'.\ItemList\escapedItemQuery($id);
            $items[] = \Page\imageArrowLinkWithDescription($title,
                $description, $href, 'schedule', ['id' => $id]);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No schedules found');
    }

}
