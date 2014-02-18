<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../classes/Form.php';
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

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Change Password';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Account',
                'href' => '../account/',
            ),
        ),
        'Change Password',
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
