<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'wallets/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => ''];

unset(
    $_SESSION['home/messages'],
    $_SESSION['wallets/errors'],
    $_SESSION['wallets/messages']
);

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Wallets',
            'href' => ItemList\listHref(),
        ],
    ],
    'New Wallet',
    Page\sessionErrors('wallets/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Wallet')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Wallet', $content, $base);
