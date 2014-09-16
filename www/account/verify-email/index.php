<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['account/messages']);

include_once '../../fns/Form/button.php';
include_once '../../fns/Form/captcha.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Account',
            'href' => '..',
        ],
    ],
    'Verify Email',
    Page\sessionErrors('account/verify-email/errors')
    .'<form action="submit.php" method="post">'
        .Form\captcha($base, true)
        .Form\button('Send Verification Email')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Verify Email', $content, $base);
