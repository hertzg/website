<?php

include_once 'lib/require-user.php';
include_once '../fns/ifset.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

if (array_key_exists('channels/add_lastpost', $_SESSION)) {
    $values = $_SESSION['channels/add_lastpost'];
} else {
    $values = array('channelname' => '');
}

unset($_SESSION['channels/index_messages']);

$page->base = '../';
$page->title = 'New Channel';
$page->finish(
    Tab::create(
        Tab::item('Notifications', '../notifications.php')
        .Tab::item('Channels', './')
        .Tab::activeItem('New'),
        Page::errors(ifset($_SESSION['channels/add_errors']))
        .Form::create(
            'submit-add.php',
            Form::textfield('channelname', 'Channel name', array(
                'value' => $values['channelname'],
                'maxlength' => 32,
                'autofocus' => true,
                'required' => true,
            ))
            .Form::notes(array(
                'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
                'Minimum 6 maximum 32 characters.',
            ))
            .Page::HR
            .Form::button('Create')
        )
    )
);
