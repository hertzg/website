<?php

function render_schedules ($user, $schedules, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($schedules) {
        include_once "$fnsDir/format_days_left.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($schedules as $schedule) {

            $id = $schedule->id;
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $title = htmlspecialchars($schedule->text);
            $description = format_days_left($user, $schedule->days_left);
            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, 'schedule', ['id' => $id]);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No schedules');
    }

}
