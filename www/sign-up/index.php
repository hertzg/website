<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

if (array_key_exists('sign-up/values', $_SESSION)) {
    $values = $_SESSION['sign-up/values'];
} else {
    $values = array(
        'username' => '',
        'email' => '',
        'password1' => '',
        'password2' => '',
    );
}

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/values'],
    $_SESSION['sign-in/messages']
);

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/captcha.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/imageLinkWithDescription.php';
include_once '../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(),
        'Sign Up',
        Page\sessionErrors('sign-up/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('username', 'Username', array(
                'value' => $values['username'],
                'autofocus' => true,
                'required' => true,
            ))
            .Form\notes(array('Minimum 6 characters.'))
            .'<div class="hr"></div>'
            .Form\textfield('email', 'Email', array(
                'value' => $values['email'],
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\password('password1', 'Password', array(
                'value' => $values['password1'],
                'required' => true,
            ))
            .Form\notes(array('Minimum 6 characters.'))
            .'<div class="hr"></div>'
            .Form\password('password2', 'Repeat password', array(
                'value' => $values['password2'],
                'required' => true,
            ))
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
