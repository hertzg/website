<?php

include_once '../lib/user.php';
if (!$user) {
    include_once '../fns/redirect.php';
    redirect('../sign-in/');
}
include_once '../fns/create_panel.php';
include_once '../fns/bytestr.php';
include_once '../fns/date_ago.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';
include_once '../lib/themes.php';

unset(
    $_SESSION['change-password_errors'],
    $_SESSION['change-password_lastpost'],
    $_SESSION['edit-profile_errors'],
    $_SESSION['edit-profile_lastpost'],
    $_SESSION['home_messages'],
    $_SESSION['tokens/index_messages']
);

if (array_key_exists('account_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['account_messages']);
} else {
    $pageMessages = '';
}

$fullname = $user->fullname;
if ($fullname !== '') {
    $fullnameField =
        Form::label('Full name', $fullname)
        .Page::HR;
} else {
    $fullnameField = '';
}

$options = array(
    Page::imageLink('Edit Profile', '../edit-profile.php', 'edit-profile'),
    Page::imageLink('Change Password', '../change-password/', 'password'),
);
include_once '../classes/Tokens.php';
$numTokens = Tokens::countOnUser($idusers);
if ($numTokens) {
    $options[] = Page::imageLinkWithDescription('Remembered Sessions', "$numTokens total.", '../tokens/', 'tokens');
} else {
    $options[] = Page::imageLink('Remembered Sessions', '../tokens/', 'tokens');
}
$options[] = Page::imageLink('Close Account', '../close-account/', 'trash-bin');

$page->base = '../';
$page->title = 'Account';
$page->finish(
    Tab::create(
        Tab::activeItem('Account'),
        $pageMessages
        .Form::label('Username', $user->username)
        .Page::HR
        .Form::label('Email', $user->email)
        .Page::HR
        .$fullnameField
        .Form::label('Theme', $themes[$user->theme])
        .Page::HR
        .Form::label('Account created', date_ago($user->inserttime))
        .Page::HR
        .Form::label('Using storage', bytestr($user->storageused))
    )
    .create_panel('Options', join(Page::HR, $options))
);
