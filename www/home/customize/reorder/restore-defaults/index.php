<?php

$base = '../../../../';
$fnsDir = '../../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['home/customize/reorder/messages']);

include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/text.php";
include_once "$fnsDir/Page/twoColumns.php";
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Reorder Items',
            'href' => '..',
        ],
    ],
    'Restore Defaults',
    Page\text('Are you sure you want to restore'
        .' the default order of the items?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, restore defaults', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Restore Defaults?', $content, $base);
