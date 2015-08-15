<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

include_once '../fns/SignUpEnabled/get.php';
if (SignUpEnabled\get()) {
    include_once '../fns/Page/sessionErrors.php';
    $pageErrors = Page\sessionErrors('sign-up/errors');
} else {
    $error = 'This form has been disabled. You no longer can sign up.';
    include_once '../fns/Page/errors.php';
    $pageErrors = Page\errors([$error]);
}

$key = 'sign-up/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once '../fns/request_strings.php';
    list($return) = request_strings('return');

    $values = [
        'username' => '',
        'password1' => '',
        'password2' => '',
        'email' => '',
        'return' => $return,
    ];

}

$return = $values['return'];

if ($return === '') $queryString = '';
else $queryString = '?return='.rawurlencode($return);

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/messages'],
    $_SESSION['sign-in/values']
);

include_once '../fns/create_panel.php';
include_once '../fns/example_password.php';
include_once '../fns/Email/maxLength.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/captcha.php';
include_once '../fns/Form/hidden.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/imageLinkWithDescription.php';
include_once '../fns/Page/tabs.php';
include_once '../fns/Username/maxLength.php';
$content = Page\tabs(
    [],
    'Sign Up',
    $pageErrors
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
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
        .Form\hidden('return', $return)
    .'</form>'
    .create_panel(
        'Options',
        Page\imageLinkWithDescription('Already have an account?',
            'Sign in here.', "../sign-in/$queryString", 'sign-in')
    )
);

include_once '../fns/echo_guest_page.php';
echo_guest_page('Sign Up', $content, $base);
