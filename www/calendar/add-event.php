<?php

include_once 'lib/require-user.php';
include_once '../fns/ifset.php';
include_once '../fns/request_strings.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

list($year, $month, $day) = request_strings('year', 'month', 'day');

$lastpost = ifset($_SESSION['calendar/add-event_lastpost']);

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
        Page::errors(ifset($_SESSION['calendar/add-event_errors']))
        .Form::create(
            'submit-add-event.php',
            Form::label('When', date('F d, Y', $time))
            .Page::HR
            .Form::textfield('eventtext', 'Text', array(
                'value' => ifset($lastpost['eventtext']),
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::button('Add Event')
            .Form::hidden('year', $year)
            .Form::hidden('month', $month)
            .Form::hidden('day', $day)
        )
    )
);
