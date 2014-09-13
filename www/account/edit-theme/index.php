<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['account/messages']);

include_once '../../fns/Themes/index.php';
$themes = Themes\index();

include_once '../../fns/Page/imageLink.php';
$items = [];
foreach ($themes as $id => $theme) {
    $href = "submit.php?theme=$id";
    if ($id == $user->theme) $theme .= ' (Current)';
    $items[] = Page\imageLink($theme, $href, "$id-theme");
}

include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/warnings.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Account',
            'href' => '..',
        ],
    ],
    'Edit Theme',
    Page\warnings(['Select theme color:'])
    .join('<div class="hr"></div>', $items)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Edit Theme', $content, $base);
