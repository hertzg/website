<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['account/messages']);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/captcha.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Account',
        'href' => '../#verify-email',
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
