<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

if (array_key_exists('edit-profile/values', $_SESSION)) {
    $values = (object)$_SESSION['edit-profile/values'];
} else {
    $values = $user;
}

unset($_SESSION['account/messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ),
            array(
                'title' => 'Account',
                'href' => '..',
            ),
        ),
        'Edit Profile',
        Page\sessionErrors('edit-profile/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('email', 'Email', array(
                'value' => $values->email,
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\textfield('full_name', 'Full name', array(
                'value' => $values->full_name,
            ))
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Edit Profile', $content, $base);
