<?php

include_once 'lib/require-token.php';
include_once '../fns/create_panel.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

unset($_SESSION['tokens/index_messages']);

$page->base = '../';
$page->finish(
    Tab::create(
        Tab::item('Account', '../account.php')
        .Tab::item('Sessions', './')
        .Tab::activeItem('View'),
        Form::textfield('tokentext', 'Identifier', array(
            'value' => bin2hex($token->tokentext),
            'readonly' => true,
        ))
        .Form::textarea('useragent', 'User agent', array(
            'value' => $token->useragent,
            'readonly' => true,
        ))
    )
    .create_panel(
        'Options',
        Page::imageLink('Delete Session', "delete.php?id=$id", 'trash-bin')
    )
);
