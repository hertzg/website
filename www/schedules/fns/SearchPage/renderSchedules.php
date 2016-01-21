<?php

namespace SearchPage;

function renderSchedules ($schedules, &$items, $params, $keyword, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($schedules) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/format_days_left.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($schedules as $schedule) {

            $id = $schedule->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $title = htmlspecialchars($schedule->text);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $description = format_days_left($user, $schedule->days_left);
            $items[] = \Page\imageArrowLinkWithDescription($title,
                $description, $href, 'schedule', ['id' => $id]);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No schedules found');
    }

}
