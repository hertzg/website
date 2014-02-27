<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/page.php';

unset($_SESSION['account/index_messages']);

include_once '../fns/get_themes.php';
$themes = get_themes();

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
$page->title = 'Edit Theme';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Account',
                'href' => '../account/',
            ),
        ),
        'Edit Theme',
        Page::warnings(array('Select theme color:'))
        .join(Page::HR, $themeItems)
    )
);
