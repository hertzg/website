<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('channels/add_lastpost', $_SESSION)) {
    $values = $_SESSION['channels/add_lastpost'];
} else {
    $values = array('channelname' => '');
}

if (array_key_exists('channels/add_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['channels/add_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['channels/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = 'New Channel';
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../notifications/',
            ],
            [
                'title' => 'Channels',
                'href' => '..',
            ],
        ],
        'New',
        $pageErrors
        .Form::create(
            'submit.php',
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
