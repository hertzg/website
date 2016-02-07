<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/get_values.php';
$values = get_values();

$username = $values['username'];
$return = $values['return'];

if ($return === '') $pageWarnings = '';
else {
    include_once '../fns/Page/warnings.php';
    $pageWarnings = Page\warnings([
        'You need to be signed in to access the page.',
    ]);
}

include_once 'fns/create_options_panel.php';
include_once '../fns/phishing_warning.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/checkbox.php';
include_once '../fns/Form/hidden.php';
include_once '../fns/Form/password.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
include_once '../fns/Page/title.php';
include_once '../fns/Username/maxLength.php';
$content =
    Page\title(
        'Sign In',
        Page\sessionMessages('sign-in/messages')
        .Page\sessionErrors('sign-in/errors')
        .$pageWarnings
        .'<form action="submit.php" method="post">'
            .Form\textfield('username', 'Username', [
                'value' => $username,
                'maxlength' => Username\maxLength(),
                'autofocus' => $username === '',
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\password('password', 'Password', [
                'value' => $values['password'],
                'autofocus' => $username !== '',
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\checkbox('remember', 'Stay signed in', $values['remember'])
            .'<div class="hr"></div>'
            .Form\button('Sign In')
            .Form\hidden('return', $return)
            .phishing_warning()
        .'</form>'
    )
    .create_options_panel($return);

include_once '../fns/compressed_js_script.php';
include_once '../fns/echo_guest_page.php';
echo_guest_page('Sign In', $content, $base, [
    'scripts' => compressed_js_script('formCheckbox', $base),
]);
