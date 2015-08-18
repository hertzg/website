<?php

include_once 'fns/require_invitation.php';
include_once '../lib/mysqli.php';
list($invitation, $key, $id) = require_invitation($mysqli);

include_once 'fns/get_values.php';
$values = get_values();

$base = '../';

if (!$invitation) {
    include_once '../fns/echo_alert_page.php';
    echo_alert_page('Link Expired',
        'You cannot sign up with this link. The link has expired.',
        '..', $base);
}

include_once '../fns/example_password.php';
include_once '../fns/Email/maxLength.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Form/password.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/tabs.php';
include_once '../fns/Password/minLength.php';
include_once '../fns/Username/maxLength.php';
include_once '../fns/Username/minLength.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '..',
        ],
    ],
    'Accept Invitation',
    Page\sessionErrors('accept-invitation/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .Form\notes([
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            'Minimum '.Username\minLength().' characters.',
        ])
        .'<div class="hr"></div>'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
        ])
        .Form\notes([
            'Minimum '.Password\minLength().' characters.',
            'Example: '.htmlspecialchars(example_password(9)),
        ])
        .'<div class="hr"></div>'
        .Form\password('repeatPassword', 'Repeat password', [
            'value' => $values['repeatPassword'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'maxlength' => Email\maxLength(),
        ])
        .Form\notes(['Optional. Used for password recovery.'])
        .'<div class="hr"></div>'
        .Form\button('Sign Up')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
        .'<input type="hidden" name="key" value="'.bin2hex($key).'" />'
    .'</form>'
);

include_once '../fns/echo_guest_page.php';
echo_guest_page('Accept Invitation', $content, $base);