<?php

include_once 'fns/require_user_without_password.php';
$user = require_user_without_password();

$fnsDir = '../../fns';

$key = 'account/unlock/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once "$fnsDir/request_strings.php";
    list($return) = request_strings('return');

    $values = [
        'password' => '',
        'return' => $return,
    ];

}

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/phishingWarning.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\create(
    [
        'title' => 'Home',
        'href' => '../../home/#account',
        'localNavigation' => true,
    ],
    'Unlock Account',
    Page\sessionErrors('account/unlock/errors')
    .Page\warnings([
        'To unlock your account please enter your account password.',
    ])
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => true,
        ])
        .Form\button('Unlock Account')
        .Form\hidden('return', $values['return'])
        .Page\phishingWarning()
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Unlock Account', $content, '../../');
