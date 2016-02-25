<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once 'fns/get_values.php';
$values = get_values();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/phishingWarning.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\create(
    [
        'title' => 'Account',
        'href' => "../#close",
    ],
    'Close',
    Page\sessionErrors('account/close/errors')
    .Page\warnings([
        'Are you sure you want to close your account?',
        'You will lose all your data.',
    ])
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Close Account')
        .Page\phishingWarning()
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Close Account', $content, $base);
