<?php

include_once '../fns/is_md5.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../classes/Users.php';
include_once '../lib/page.php';
include_once '../lib/session-start.php';

list($idusers, $resetpasswordkey) = request_strings('idusers', 'resetpasswordkey');

if (!is_md5($resetpasswordkey)) redirect();

$user = Users::getByResetPasswordKey($idusers, $resetpasswordkey);
if (!$user) redirect();

if (array_key_exists('reset-password_lastpost', $_SESSION)) {
    $values = $_SESSION['reset-password_lastpost'];
} else {
    $values = array(
        'password1' => '',
        'password2' => '',
    );
}

if (array_key_exists('reset-password_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['reset-password_errors']);
} else {
    $pageErrors = '';
}

unset(
    $_SESSION['sign-in_errors'],
    $_SESSION['sign-in_lastpost'],
    $_SESSION['sign-in_messages']
);

$page->base = '../';
$page->title = 'Reset Password';
$page->finish(
    Tab::create(
        Tab::item('Sign In', '../sign-in/')
        .Tab::activeItem('Reset Password'),
        $pageErrors
        .Form::create(
            'submit.php',
            Form::label('Username', $user->username)
            .Page::HR
            .Form::password('password1', 'New password', array(
                'value' => $values['password1'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::password('password2', 'Repeat new password', array(
                'value' => $values['password2'],
                'required' => true,
            ))
            .Page::HR
            .Form::button('Reset Password')
            .Form::hidden('idusers', $idusers)
            .Form::hidden('resetpasswordkey', $resetpasswordkey)
        )
    )
);
