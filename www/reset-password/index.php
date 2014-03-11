<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

include_once '../fns/request_strings.php';
list($idusers, $key) = request_strings('idusers', 'key');

include_once '../fns/is_md5.php';
if (!is_md5($key)) {
    include_once '../fns/redirect.php';
    redirect('..');
}

include_once '../fns/Users/getByResetPasswordKey.php';
include_once '../lib/mysqli.php';
$user = Users\getByResetPasswordKey($mysqli, $idusers, $key);

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

unset(
    $_SESSION['sign-in/index_errors'],
    $_SESSION['sign-in/index_lastpost'],
    $_SESSION['sign-in/index_messages']
);

include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/hidden.php';
include_once '../fns/Form/label.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Sign In',
                'href' => '../sign-in/',
            ),
        ),
        'Reset Password',
        Page\sessionErrors('reset-password/index_errors')
        .'<form action="submit.php" method="post">'
            .Form\label('Username', $user->username)
            .'<div class="hr"></div>'
            .Form\password('password1', 'New password', array(
                'value' => $values['password1'],
                'autofocus' => true,
                'required' => true,
            ))
            .Form\notes(array('Minimum 6 characters.'))
            .'<div class="hr"></div>'
            .Form\password('password2', 'Repeat new password', array(
                'value' => $values['password2'],
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Reset Password')
            .Form\hidden('idusers', $idusers)
            .Form\hidden('key', $key)
        .'</form>'
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Reset Password', $content, $base);
