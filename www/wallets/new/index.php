<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/textfield.php";
$content =
    '<form action="submit.php" method="post">'
        .Form\textfield('name', 'Name', [
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Wallet')
    .'</form>';

include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Wallets',
            'href' => '../',
        ],
    ],
    'New',
    $content
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Wallet', $content, $base);
