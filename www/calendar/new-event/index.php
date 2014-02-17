<?php

include_once 'lib/require-user.php';
include_once '../../classes/Form.php';
include_once '../../lib/page.php';

include_once '../../fns/request_strings.php';
list($year, $month, $day) = request_strings('year', 'month', 'day');

if (array_key_exists('calendar/add-event_lastpost', $_SESSION)) {
    $values = $_SESSION['calendar/add-event_lastpost'];
} else {
    $values = array('eventtext' => '');
}

if (array_key_exists('calendar/add-event_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['calendar/add-event_errors']);
} else {
    $pageErrors = '';
}

$year = (int)$year;
$month = (int)$month;
$day = (int)$day;
$time = mktime(0, 0, 0, $month, $day, $year);

unset($_SESSION['calendar/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = 'New Event';
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'Calendar',
                'href' => '..',
            ],
        ],
        'New Event',
        $pageErrors
        .Form::create(
            'submit.php',
            Form::label('When', date('F d, Y', $time))
            .Page::HR
            .Form::textfield('eventtext', 'Text', array(
                'value' => $values['eventtext'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::button('Save')
            .Form::hidden('year', $year)
            .Form::hidden('month', $month)
            .Form::hidden('day', $day)
        )
    )
);
