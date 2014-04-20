<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

$key = 'sign-up/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'username' => '',
        'email' => '',
        'password1' => '',
        'password2' => '',
    ];
}

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/values'],
    $_SESSION['sign-in/messages']
);

include_once '../fns/create_panel.php';
include_once '../fns/Page/tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/captcha.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/imageLinkWithDescription.php';
include_once '../fns/Page/sessionErrors.php';
$content = create_tabs(
    [],
    'Sign Up',
    Page\sessionErrors('sign-up/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'autofocus' => true,
            'required' => true,
        ])
        .Form\notes([
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            'Minimum 6 characters.',
        ])
        .'<div class="hr"></div>'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\password('password1', 'Password', [
            'value' => $values['password1'],
            'required' => true,
        ])
        .Form\notes(['Minimum 6 characters.'])
        .'<div class="hr"></div>'
        .Form\password('password2', 'Repeat password', [
            'value' => $values['password2'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\captcha($base)
        .Form\button('Sign Up')
    .'</form>'
    .create_panel(
        'Options',
        Page\imageLinkWithDescription('Already have an account?',
            'Sign in here.', '../sign-in/', 'sign-in')
    )
);

include_once '../fns/echo_guest_page.php';
echo_guest_page('Sign Up', $content, $base);
