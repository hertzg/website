<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/page.php';
include_once '../lib/themes.php';

unset($_SESSION['account/index_messages']);

$themeItems = array();
foreach ($themes as $id => $theme) {
    $href = "submit.php?theme=$id";
    if ($id == $user->theme) {
        $theme .= ' (Current)';
    }
    $themeItems[] = Page::imageLink($theme, $href, "$id-theme");
}

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Edit Profile';
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => 'Account',
                'href' => '../account/',
            ],
        ],
        'Profile',
        Page::warnings(array('Select theme color:'))
        .join(Page::HR, $themeItems)
    )
);
