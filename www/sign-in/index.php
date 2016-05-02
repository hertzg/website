<?php

include_once '../../lib/defaults.php';

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/get_values.php';
$values = get_values();

$focus = $values['focus'];
$return = $values['return'];

if ($return === '') $pageWarnings = '';
else {
    include_once '../fns/Page/warnings.php';
    $pageWarnings = Page\warnings([
        'You need to be signed in to access the page.',
    ]);
}

include_once 'fns/create_options_panel.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/checkbox.php';
include_once '../fns/Form/hidden.php';
include_once '../fns/Form/password.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/phishingWarning.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
include_once '../fns/Page/title.php';
include_once '../fns/Username/maxLength.php';
$content =
    Page\title(
        'Sign In',
        Page\sessionMessages('sign-in/messages')
        .Page\sessionErrors('sign-in/errors', [
            'ENTER_PASSWORD' => 'Enter password.',
            'ENTER_USERNAME' => 'Enter username.',
            'INVALID_USERNAME' => 'The username is invalid.',
            'USER_DISABLED' => 'Your account is disabled.',
            'RATE_LIMITED' => 'Too many signin attempts from your'
                .' IP address. Please, try signing in later.',
            'INVALID_USERNAME_OR_PASSWORD' => 'Invalid username or password.',
        ])
        .$pageWarnings
        .'<form action="submit.php" method="post">'
            .Form\textfield('username', 'Username', [
                'value' => $values['username'],
                'maxlength' => Username\maxLength(),
                'autofocus' => $focus === 'username',
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\password('password', 'Password', [
                'value' => $values['password'],
                'autofocus' => $focus === 'password',
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\checkbox('remember', 'Stay signed in', $values['remember'])
            .Form\button('Sign In', null, $focus === 'button')
            .Form\hidden('return', $return)
            .Page\phishingWarning()
        .'</form>'
    )
    .create_options_panel($return);

include_once '../fns/compressed_js_script.php';
include_once '../fns/echo_guest_page.php';
echo_guest_page('Sign In', $content, $base, [
    'scripts' => compressed_js_script('formCheckbox', $base),
]);
