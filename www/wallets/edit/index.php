<?php

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

$fnsDir = '../../fns';

$key = 'wallets/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => $wallet->name];

include_once "$fnsDir/Wallets/maxLengths.php";
$maxLengths = Wallets\maxLengths();

unset($_SESSION['wallets/view/messages']);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Wallet #$id",
            'href' => "../view/?id=$id#edit",
        ],
    ],
    'Edit',
    '<form action="submit.php" method="post">'
        .Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'maxlength' => $maxLengths['name'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Edit Wallet #$id", $content, '../../');
