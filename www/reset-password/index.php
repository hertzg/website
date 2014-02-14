<?php

include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../classes/Users.php';
include_once '../lib/page.php';
include_once '../lib/session-start.php';

include_once '../fns/request_strings.php';
list($idusers, $resetpasswordkey) = request_strings(
    'idusers', 'resetpasswordkey');

include_once '../fns/is_md5.php';
if (!is_md5($resetpasswordkey)) {
    include_once '../fns/redirect.php';
    redirect('..');
}

include_once '../fns/Users/getByResetPasswordKey.php';
include_once '../lib/mysqli.php';
$user = Users\getByResetPasswordKey($mysqli, $idusers, $resetpasswordkey);

if (!$user) {
    include_once '../fns/redirect.php';
    redirect('..');
}

if (array_key_exists('reset-password/index_lastpost', $_SESSION)) {
    $values = $_SESSION['reset-password/index_lastpost'];
} else {
    $values = array(
        'password1' => '',
        'password2' => '',
    );
}

if (array_key_exists('reset-password/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['reset-password/index_errors']);
} else {
    $pageErrors = '';
}

unset(
    $_SESSION['sign-in/index_errors'],
    $_SESSION['sign-in/index_lastpost'],
    $_SESSION['sign-in/index_messages']
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
