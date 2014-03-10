<?php

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('account/verify-email/index_errors');

unset($_SESSION['account/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/captcha.php';
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
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\captcha('../../', true)
            .Form\button('Send Verification Email')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Verify Email', $content, '../../');
