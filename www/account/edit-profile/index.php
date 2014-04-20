<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'account/edit-profile/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$user;

unset($_SESSION['account/messages']);

include_once '../../fns/Users/maxLengths.php';
$maxLengths = Users\maxLengths();

include_once '../../fns/Page/tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Account',
            'href' => '..',
        ],
    ],
    'Edit Profile',
    Page\sessionErrors('account/edit-profile/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'maxlength' => $maxLengths['email'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('full_name', 'Full name', [
            'value' => $values['full_name'],
            'maxlength' => $maxLengths['full_name'],
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Edit Profile', $content, $base);
