<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['account/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/captcha.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => ' &middot;&middot;&middot; ',
                'href' => '../../',
            ),
            array(
                'title' => 'Account',
                'href' => '../',
            ),
        ),
        'Verify Email',
        Page\sessionErrors('account/verify-email/index_errors')
        .'<form action="submit.php" method="post">'
            .Form\captcha($base, true)
            .Form\button('Send Verification Email')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Verify Email', $content, $base);
