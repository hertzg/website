<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['account/messages']);

include_once "$fnsDir/phishing_warning.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\tabs(
    [
        [
            'title' => 'Account',
            'href' => "../#close",
        ],
    ],
    'Close',
    Page\sessionErrors('account/close/errors')
    .Page\warnings([
        'Are you sure you want to close your account?',
        'You will lose all your data.',
    ])
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'Password', [
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Close Account')
        .phishing_warning()
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Close Account', $content, $base);
