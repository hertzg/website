<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['account/messages']);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/captcha.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Account',
            'href' => '../#verify-email',
        ],
    ],
    'Verify Email',
    Page\sessionErrors('account/verify-email/errors')
    .'<form action="submit.php" method="post">'
        .Form\captcha($base, true)
        .Form\button('Send Verification Email')
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Verify Email', $content, $base);
