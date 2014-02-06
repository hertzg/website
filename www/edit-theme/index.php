<?php

include_once 'lib/require-user.php';
include_once '../classes/Tab.php';
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

$page->base = '../';
$page->title = 'Edit Profile';
$page->finish(
    Tab::create(
        Tab::item('Account', '../account/')
        .Tab::activeItem('Profile'),
        Page::warnings(array('Select theme color:'))
        .join(Page::HR, $themeItems)
    )
);
