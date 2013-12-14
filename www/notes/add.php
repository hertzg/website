<?php

include_once 'lib/require-user.php';
include_once '../fns/request_strings.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$lastpost = ifset($_SESSION['notes/add_lastpost']);

unset($_SESSION['notes/index_messages']);

$page->base = '../';
$page->title = 'New Note';
$page->finish(
    Tab::create(
        Tab::item('Notes', './')
        .Tab::activeItem('New'),
        Page::errors(ifset($_SESSION['notes/add_errors']))
        .Form::create(
            'submit-add.php',
            Form::textarea('notetext', 'Text', array(
                'value' => ifset($lastpost['notetext']),
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::button('Save')
        )
    )
);
