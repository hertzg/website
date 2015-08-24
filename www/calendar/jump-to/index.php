<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/Date/request.php";
list($day, $month, $year) = Date\request();

include_once "$fnsDir/user_time_today.php";
$maxYear = date('Y', user_time_today($user));
$minYear = 1900;
$year = max($minYear, min($maxYear, (int)$year));

$monthOptions = [
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December',
];

$yearOptions = [];
for ($i = $maxYear; $i >= $minYear; $i--) $yearOptions[$i] = $i;

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages']
);

include_once '../fns/calendar_href.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/datefield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Calendar',
            'href' => calendar_href($day, $month, $year).'#jump-to',
        ],
    ],
    'Jump To',
    Page\sessionErrors('calendar/jump-to/errors')
    .'<form action="submit.php" method="post">'
        .Form\datefield(
            [
                'name' => 'day',
                'value' => $day,
            ],
            [
                'name' => 'month',
                'value' => $month,
            ],
            [
                'name' => 'year',
                'value' => $year,
            ],
            'Select a day',
            true
        )
        .'<div class="hr"></div>'
        .Form\button('Jump To')
    .'</form>'
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Jumo To', $content, $base, [
    'scripts' => compressed_js_script('dateField', $base),
]);
