<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

include_once '../fns/SignUpEnabled/get.php';
if (SignUpEnabled\get()) {
    include_once '../fns/Page/sessionErrors.php';
    $pageErrors = Page\sessionErrors('sign-up/errors');
} else {
    include_once '../fns/Page/errors.php';
    $pageErrors = Page\errors([
        'This form has been disabled. You no longer can create an account.',
    ]);
}

include_once 'fns/get_values.php';
$values = get_values();

$focus = $values['focus'];
$return = $values['return'];

if ($return === '') $queryString = '';
else $queryString = '?return='.rawurlencode($return);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

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
include_once '../fns/Page/title.php';
include_once '../fns/Password/minLength.php';
include_once '../fns/Username/maxLength.php';
include_once '../fns/Username/minLength.php';
$content =
    Page\title(
        'Create an Account',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\textfield('username', 'Username', [
                'value' => $values['username'],
                'maxlength' => Username\maxLength(),
                'autofocus' => $focus === 'username',
                'required' => true,
            ])
            .Form\notes([
                'Case-sensitive.',
                'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
                'Minimum '.Username\minLength().' characters.',
            ])
            .'<div class="hr"></div>'
            .Form\password('password', 'Password', [
                'value' => $values['password'],
                'autofocus' => $focus === 'password',
                'required' => true,
            ])
            .Form\notes([
                'Minimum '.Password\minLength().' characters.',
                'Example: '.htmlspecialchars(example_password(9)),
            ])
            .'<div class="hr"></div>'
            .Form\password('repeatPassword', 'Repeat password', [
                'value' => $values['repeatPassword'],
                'autofocus' => $focus === 'repeatPassword',
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('email', 'Email', [
                'value' => $values['email'],
                'maxlength' => Email\maxLength(),
                'autofocus' => $focus === 'email',
            ])
            .Form\notes(['Optional. Used for password recovery.'])
            .'<div class="hr"></div>'
            .Form\captcha($base, $focus === 'captcha')
            .Form\button('Create an Account')
            .Form\hidden('return', $return)
        .'</form>'
    )
    .create_panel(
        'Options',
        Page\imageLinkWithDescription('Already have an account?',
            'Sign in here.', "../sign-in/$queryString", 'sign-in',
            ['localNavigation' => true])
    );

include_once '../fns/echo_guest_page.php';
echo_guest_page('Create an Account', $content, $base);
