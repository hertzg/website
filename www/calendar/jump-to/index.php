<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../lib/page.php';

include_once '../../fns/request_strings.php';
list($month, $year) = request_strings('month', 'year');

$timeNow = time();
$minYear = 1900;
$maxYear = date('Y', $timeNow) + 100;

$year = max($minYear, min($maxYear, (int)$year));
$month = max(1, min(12, (int)$month));

$monthOptions = array(
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
);

$yearOptions = array();
for ($i = $minYear; $i <= $maxYear; $i++) {
    $yearOptions[$i] = $i;
}

unset($_SESSION['calendar/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/select.php';

$page->base = '../../';
$page->title = 'Jumo To';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Calendar',
                'href' => "../?year=$year&month=$month",
            ),
        ),
        'Jump To',
        '<form action="submit.php" method="post">'
            .Form\select('month', 'Month:', $monthOptions, $month)
            .'<div class="hr"></div>'
            .Form\select('year', 'Year:', $yearOptions, $year)
            .'<div class="hr"></div>'
            .Form\button('Jump To')
        .'</form>'
    )
);
