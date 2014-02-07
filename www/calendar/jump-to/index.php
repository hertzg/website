<?php

include_once 'lib/require-user.php';
include_once '../../fns/request_strings.php';
include_once '../../classes/Form.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

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

$page->base = '../../';
$page->title = 'Jumo To';
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', "../..")
        .Tab::item('Calendar', "../?year=$year&month=$month")
        .Tab::activeItem('Jump To'),
        Form::create(
            'submit.php',
            Form::select('month', 'Month:', $monthOptions, $month)
            .Page::HR
            .Form::select('year', 'Year:', $yearOptions, $year)
            .Page::HR
            .Form::button('Jump To')
        )
    )
);
