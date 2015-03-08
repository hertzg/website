<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

$key = 'sign-up/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'username' => '',
        'password1' => '',
        'password2' => '',
        'email' => '',
    ];
}

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/messages'],
    $_SESSION['sign-in/values']
);

include_once '../fns/Users/maxLengths.php';
$maxLengths = Users\maxLengths();

include_once '../fns/create_panel.php';
include_once '../fns/example_password.php';
include_once '../fns/Email/maxLength.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/captcha.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/imageLinkWithDescription.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [],
    'Sign Up',
    Page\sessionErrors('sign-up/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => $maxLengths['username'],
            'autofocus' => true,
            'required' => true,
        ])
        .Form\notes([
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            'Minimum 6 characters.',
        ])
        .'<div class="hr"></div>'
        .Form\password('password1', 'Password', [
            'value' => $values['password1'],
            'required' => true,
        ])
        .Form\notes([
            'Minimum 6 characters.',
            'Example: '.htmlspecialchars(example_password(9)),
        ])
        .'<div class="hr"></div>'
        .Form\password('password2', 'Repeat password', [
            'value' => $values['password2'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'maxlength' => Email\maxLength(),
        ])
        .Form\notes(['Optional. Used for password recovery.'])
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
