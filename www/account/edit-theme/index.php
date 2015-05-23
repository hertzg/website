<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['account/messages']);

include_once "$fnsDir/Themes/index.php";
$themes = Themes\index();

include_once "$fnsDir/Page/imageLink.php";
$items = [];
foreach ($themes as $id => $theme) {
    $href = "submit.php?theme=$id";
    if ($id == $user->theme) $theme .= ' (Current)';
    $items[] = Page\imageLink($theme, $href, "$id-theme");
}

include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\tabs(
    [
        [
            'title' => 'Account',
            'href' => '../#edit-theme',
        ],
    ],
    'Edit Theme',
    Page\sessionMessages('account/edit-theme/messages')
    .Page\warnings(['Select theme color:'])
    .join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Edit Theme', $content, $base);
