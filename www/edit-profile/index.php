<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

if (array_key_exists('edit-profile/index_lastpost', $_SESSION)) {
    $values = (object)$_SESSION['edit-profile/index_lastpost'];
} else {
    $values = $user;
}

unset($_SESSION['account/index_messages']);

include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Account',
                'href' => '../account/',
            ),
        ),
        'Edit Profile',
        Page\sessionErrors('edit-profile/index_errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('email', 'Email', array(
                'value' => $values->email,
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\textfield('fullname', 'Full name', array(
                'value' => $values->fullname,
            ))
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
        .'</form>'
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Edit Profile', $content, $base);
