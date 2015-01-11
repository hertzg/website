<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'wallets/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => ''];

unset(
    $_SESSION['wallets/errors'],
    $_SESSION['wallets/messages']
);

include_once "$fnsDir/Wallets/maxLengths.php";
$maxLengths = Wallets\maxLengths();

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/textfield.php";
$content =
    '<form action="submit.php" method="post">'
        .Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'maxlength' => $maxLengths['name'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Wallet')
    .'</form>';

include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Wallets',
            'href' => '../',
        ],
    ],
    'New',
    Page\sessionErrors('wallets/new/errors')
    .$content
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Wallet', $content, $base);
