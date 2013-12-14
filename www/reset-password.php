<?php

include_once 'fns/is_md5.php';
include_once 'fns/hex2bin.php';
include_once 'fns/redirect.php';
include_once 'fns/request_strings.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';
include_once 'classes/Users.php';
include_once 'lib/session-start.php';

list($idusers, $resetpasswordkey) = request_strings('idusers', 'resetpasswordkey');

if (!is_md5($resetpasswordkey)) redirect();

$user = Users::getByResetPasswordKey($idusers, $resetpasswordkey);
if (!$user) redirect();

$lastpost = ifset($_SESSION['reset-password_lastpost']);

unset(
    $_SESSION['signin_errors'],
    $_SESSION['signin_lastpost'],
    $_SESSION['signin_messages'],
    $_SESSION['signup_errors'],
    $_SESSION['signup_lastpost']
);

$page->title = 'Reset Password';
$page->finish(
    Tab::create(
        Tab::item('Sign In', 'signin.php')
        .Tab::item('Sign Up', 'signup.php')
        .Tab::activeItem('Reset Password'),
        Page::errors(ifset($_SESSION['reset-password_errors']))
        .Form::create(
            'submit-reset-password.php',
            Form::label('Username', $user->username)
            .Page::HR
            .Form::password('password1', 'New password', array(
                'value' => ifset($lastpost['password1']),
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::password('password2', 'Repeat new password', array(
                'value' => ifset($lastpost['password2']),
                'required' => true,
            ))
            .Page::HR
            .Form::button('Reset Password')
            .Form::hidden('idusers', $idusers)
            .Form::hidden('resetpasswordkey', $resetpasswordkey)
        )
    )
);
