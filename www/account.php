<?php

include_once 'lib/require-user.php';
include_once 'fns/create_panel.php';
include_once 'fns/bytestr.php';
include_once 'fns/date_ago.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';
include_once 'lib/themes.php';

unset(
    $_SESSION['change-password_errors'],
    $_SESSION['change-password_lastpost'],
    $_SESSION['edit-profile_errors'],
    $_SESSION['edit-profile_lastpost'],
    $_SESSION['home_messages']
);

if (array_key_exists('account_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['account_messages']);
} else {
    $pageMessages = '';
}

$page->title = 'Account';
$page->finish(
    Tab::create(
        Tab::activeItem('Account'),
        $pageMessages
        .Form::label('Username', $user->username)
        .Page::HR
        .Form::label('Email', $user->email)
        .Page::HR
        .Form::label('Full name', $user->fullname)
        .Page::HR
        .Form::label('Theme', $themes[$user->theme])
        .Page::HR
        .Form::label('Account created', date_ago($user->inserttime))
        .Page::HR
        .Form::label('Using storage', bytestr($user->storageused))
    )
    .create_panel(
        'Options',
        Page::imageLink('Edit Profile', 'edit-profile.php', 'edit-profile')
        .Page::HR
        .Page::imageLink('Change Password', 'change-password.php', 'password')
        .Page::HR
        .Page::imageLink('Close Account', 'close-account.php', 'trash-bin')
    )
);
