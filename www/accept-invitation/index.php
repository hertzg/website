<?php

include_once '../../lib/defaults.php';

include_once 'fns/request_invitation.php';
include_once '../lib/mysqli.php';
list($invitation, $key, $id) = request_invitation($mysqli);

$base = '../';

if (!$invitation) {
    include_once '../fns/echo_alert_page.php';
    echo_alert_page('Link Expired',
        'You cannot create an account with this link. The link has expired.',
        '..', $base);
}

include_once 'fns/get_values.php';
$values = get_values();

$focus = $values['focus'];

include_once '../fns/example_password.php';
include_once '../fns/Email/maxLength.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Form/password.php';
include_once '../fns/Page/create.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Password/minLength.php';
include_once '../fns/Username/maxLength.php';
include_once '../fns/Username/minLength.php';
$content = Page\create(
    [
        'title' => 'Home',
        'href' => '..',
        'localNavigation' => true,
    ],
    'Accept Invitation',
    Page\sessionErrors('accept-invitation/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => $focus === 'username',
        ])
        .Form\notes([
            'Case-sensitive.',
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            'Minimum '.Username\minLength().' characters.',
        ])
        .'<div class="hr"></div>'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => $focus === 'password',
        ])
        .Form\notes([
            'Minimum '.Password\minLength().' characters.',
            'Example: '.htmlspecialchars(example_password(9)),
        ])
        .'<div class="hr"></div>'
        .Form\password('repeatPassword', 'Repeat password', [
            'value' => $values['repeatPassword'],
            'required' => true,
            'autofocus' => $focus === 'repeatPassword',
        ])
        .'<div class="hr"></div>'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'maxlength' => Email\maxLength(),
            'autofocus' => $focus === 'email',
        ])
        .Form\notes(['Optional. Used for password recovery.'])
        .Form\button('Sign Up')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
        .'<input type="hidden" name="key" value="'.bin2hex($key).'" />'
    .'</form>'
);

include_once '../fns/echo_guest_page.php';
echo_guest_page('Accept Invitation', $content, $base);
