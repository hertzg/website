<?php

include_once 'lib/require-user.php';
include_once '../fns/request_strings.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

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

$page->base = '../';
$page->finish(
    Tab::create(
        Tab::item('Calendar', './')
        .Tab::activeItem('New Event'),
        $pageErrors
        .Form::create(
            'submit-add-event.php',
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
