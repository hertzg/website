<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/page.php';

if (array_key_exists('change-password/index_lastpost', $_SESSION)) {
    $values = $_SESSION['change-password/index_lastpost'];
} else {
    $values = array(
        'currentpassword' => '',
        'password1' => '',
        'password2' => '',
    );
}

include_once '../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('change-password/index_errors');

unset($_SESSION['account/index_messages']);

include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
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
        'Change Password',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\password('currentpassword', 'Current password', array(
                'value' => $values['currentpassword'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\password('password1', 'New password', array(
                'value' => $values['password1'],
                'required' => true,
            ))
            .Form\notes(array('Minimum 6 characters.'))
            .'<div class="hr"></div>'
            .Form\password('password2', 'Repeat new password', array(
                'value' => $values['password2'],
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Change')
        .'</form>'
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Change Password', $content, '../');
