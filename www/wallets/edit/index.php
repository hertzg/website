<?php

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

$fnsDir = '../../fns';

$key = 'wallets/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => $wallet->name];

unset(
    $_SESSION['wallets/view/errors'],
    $_SESSION['wallets/view/messages']
);

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Wallet #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('wallets/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Wallet #$id", $content, '../../');
