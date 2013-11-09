<?php

include_once 'lib/require-user.php';
include_once 'fns/ifset.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';
include_once 'lib/themes.php';

$lastpost = ifset($_SESSION['edit-profile_lastpost']);

unset($_SESSION['account_messages']);

$themes_html = '';
$first = true;
foreach ($themes as $id => $theme) {
    if ($first) $first = false;
    else $themes_html .= Page::HR;
    $href = "submit-edit-theme.php?theme=$id";
    if ($id == $user->theme) {
        $theme .= ' (Active)';
    }
    $themes_html .= Page::imageLink($theme, $href, "$id-theme");
}

$page->title = 'Edit Profile';
$page->finish(
    Tab::create(
        Tab::item('Home', 'home.php')
        .Tab::item('Account', 'account.php')
        .Tab::activeItem('Profile')
    )
    .Page::errors(ifset($_SESSION['edit-profile_errors']))
    .Form::create(
        'submit-edit-profile.php',
        Form::textfield('email', 'Email', array(
            'value' => ifset($lastpost['email'], $user->email),
            'autofocus' => true,
            'required' => true,
        ))
        .Page::HR
        .Form::textfield('fullname', 'Full name', array(
            'value' => ifset($lastpost['fullname'], $user->fullname),
        ))
        .Page::HR
        .Form::button('Save Changes')
    )
    .Tab::create(
        Tab::activeItem('Theme')
    )
    .$themes_html
);
