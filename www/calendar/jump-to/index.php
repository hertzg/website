<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/user_time_today.php";
$yearToday = date('Y', user_time_today($user));

$maxYear = $yearToday + 100;
$minYear = $yearToday - 100;

include_once "$fnsDir/Date/request.php";
list($day, $month, $year) = Date\request();

$year = max($minYear, min($maxYear, (int)$year));

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages']
);

include_once '../fns/calendar_href.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/datefield.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Calendar',
        'href' => calendar_href($day, $month, $year).'#jump-to',
    ],
    'Jump To',
    Page\sessionErrors('calendar/jump-to/errors')
    .'<form action="submit.php" method="post">'
        .Form\datefield(
            [
                'name' => 'day',
                'value' => $day,
                'autofocus' => true,
            ],
            [
                'name' => 'month',
                'value' => $month,
            ],
            [
                'name' => 'year',
                'value' => $year,
                'min' => $minYear,
                'max' => $maxYear,
            ],
            'Select a day',
            true
        )
        .'<div class="hr"></div>'
        .Form\button('Jump To')
    .'</form>'
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Jumo To', $content, $base, [
    'scripts' => compressed_js_script('dateField', $base),
]);
