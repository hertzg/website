<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

if (array_key_exists('change-password/values', $_SESSION)) {
    $values = $_SESSION['change-password/values'];
} else {
    $values = array(
        'currentpassword' => '',
        'password1' => '',
        'password2' => '',
    );
}

unset($_SESSION['account/messages']);

include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../home/',
            ),
            array(
                'title' => 'Account',
                'href' => '../account/',
            ),
        ),
        'Change Password',
        Page\sessionErrors('change-password/errors')
        .'<form action="submit.php" method="post">'
            .Form\password('currentpassword', 'Current password', array(
                'value' => $values['currentpassword'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\password('password1', 'New password', array(
                'value' => $values['password1'],
                'required' => true,
            ))
            .Form\notes(array('Minimum 6 characters.'))
            .'<div class="hr"></div>'
            .Form\password('password2', 'Repeat new password', array(
                'value' => $values['password2'],
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Change')
        .'</form>'
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Change Password', $content, $base);
