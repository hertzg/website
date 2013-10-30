<?php

include_once 'lib/require-user.php';
include_once 'fns/ifset.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';

$lastpost = ifset($_SESSION['change-password_lastpost']);

unset($_SESSION['account_messages']);

$page->title = 'Change password';
$page->finish(
    Tab::create(
        Tab::item('Home', 'home.php')
        .Tab::item('Account', 'account.php')
        .Tab::activeItem('Change Password')
    )
    .Page::errors(ifset($_SESSION['change-password_errors']))
    .Form::create(
        'submit-change-password.php',
        Form::password('currentpassword', 'Current password', array(
            'value' => ifset($lastpost['currentpassword']),
        ))
        .Page::HR
        .Form::password('password1', 'New password', array(
            'value' => ifset($lastpost['password1']),
        ))
        .Form::notes(array('Minimum 6 characters.'))
        .Page::HR
        .Form::password('password2', 'Repeat new password', array(
            'value' => ifset($lastpost['password2']),
        ))
        .Page::HR
        .Form::button('Change')
    )
);
