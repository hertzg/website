<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/request_strings.php';
list($month, $year) = request_strings('month', 'year');

$maxYear = date('Y');
$minYear = $maxYear - 100;

$year = max($minYear, min($maxYear, (int)$year));
$month = max(1, min(12, (int)$month));

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
for ($i = $maxYear; $i >= $minYear; $i--) {
    $yearOptions[$i] = $i;
}

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages']
);

include_once '../../fns/Page/tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/select.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Calendar',
            'href' => "../?year=$year&month=$month",
        ],
    ],
    'Jump To',
    '<form action="submit.php" method="post">'
        .Form\select('month', 'Month:', $monthOptions, $month)
        .'<div class="hr"></div>'
        .Form\select('year', 'Year:', $yearOptions, $year)
        .'<div class="hr"></div>'
        .Form\button('Jump To')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Jumo To', $content, $base);
