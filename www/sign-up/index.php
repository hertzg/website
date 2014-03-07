<?php

include_once '../fns/require_guest_user.php';
require_guest_user('../');

include_once '../fns/create_panel.php';
include_once '../lib/page.php';

if (array_key_exists('sign-up/index_lastpost', $_SESSION)) {
    $values = $_SESSION['sign-up/index_lastpost'];
} else {
    $values = array(
        'username' => '',
        'email' => '',
        'password1' => '',
        'password2' => '',
    );
}

include_once '../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('sign-up/index_errors');

unset(
    $_SESSION['sign-in/index_errors'],
    $_SESSION['sign-in/index_lastpost'],
    $_SESSION['sign-in/index_messages']
);

$base = '../';

include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/captcha.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Form/textfield.php';

$page->base = $base;
$page->hideSignOutLink = true;
$page->title = 'Sign Up';
$page->finish(
    create_tabs(
        array(),
        'Sign Up',
        $pageErrors
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
            Page::imageArrowLinkWithDescription('Already have an account?',
                'Sign in here.', '../sign-in/', 'sign-in')
        )
    )
);
