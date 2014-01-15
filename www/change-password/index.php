<?php

include_once 'lib/require-user.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

if (array_key_exists('change-password/index_lastpost', $_SESSION)) {
    $values = $_SESSION['change-password/index_lastpost'];
} else {
    $values = array(
        'currentpassword' => '',
        'password1' => '',
        'password2' => '',
    );
}

if (array_key_exists('change-password/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['change-password/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['account/index_messages']);

$page->base = '../';
$page->title = 'Change password';
$page->finish(
    Tab::create(
        Tab::item('Account', '../account/')
        .Tab::activeItem('Change Password'),
        $pageErrors
        .Form::create(
            'submit.php',
            Form::password('currentpassword', 'Current password', array(
                'value' => $values['currentpassword'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::password('password1', 'New password', array(
                'value' => $values['password1'],
                'required' => true,
            ))
            .Form::notes(array('Minimum 6 characters.'))
            .Page::HR
            .Form::password('password2', 'Repeat new password', array(
                'value' => $values['password2'],
                'required' => true,
            ))
            .Page::HR
            .Form::button('Change')
        )
    )
);
