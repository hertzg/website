<?php

include_once '../fns/require_guest_user.php';
require_guest_user('../');

if (array_key_exists('email-reset-password/index_lastpost', $_SESSION)) {
    $values = $_SESSION['email-reset-password/index_lastpost'];
} else {
    $values = array('email' => '');
}

include_once '../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('email-reset-password/index_errors');

unset(
    $_SESSION['sign-in/index_errors'],
    $_SESSION['sign-in/index_lastpost'],
    $_SESSION['sign-in/index_messages']
);

$base = '../';

include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/captcha.php';
include_once '../fns/Form/textfield.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Sign In',
                'href' => '../sign-in/',
            ),
        ),
        'Reset Password',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\textfield('email', 'Email', array(
                'value' => $values['email'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\captcha($base)
            .Form\button('Send Recovery Email')
        .'</form>'
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Reset Password', $content, $base, array(
    'hideSignOutLink' => true,
));
