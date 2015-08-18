<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['account/messages']);

$color_items = [];
include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Theme/Color/index.php";
foreach (Theme\Color\index() as $id => $color) {
    $href = "submit-color.php?color=$id";
    if ($id == $user->theme_color) $color .= ' (Current)';
    $color_items[] = Page\imageLink($color,
        $href, "$id-$user->theme_brightness-theme");
}

$brightness_items = [];
include_once "$fnsDir/Theme/Brightness/index.php";
foreach (Theme\Brightness\index() as $id => $brightness) {
    $href = "submit-brightness.php?brightness=$id";
    if ($id == $user->theme_brightness) $brightness .= ' (Current)';
    $brightness_items[] = Page\imageLink($brightness,
        $href, "$user->theme_color-$id-theme");
}

include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/text.php";
$content = Page\tabs(
    [
        [
            'title' => 'Account',
            'href' => '../#edit-theme',
        ],
    ],
    'Edit Theme',
    Page\sessionMessages('account/edit-theme/messages')
    .Page\text('Select theme color:')
    .join('<div class="hr"></div>', $color_items)
    .Page\text('Select theme brightness:')
    .join('<div class="hr"></div>', $brightness_items)
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Edit Theme', $content, $base);
