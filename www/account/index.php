<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/create_panel.php';
include_once '../fns/bytestr.php';
include_once '../fns/date_ago.php';
include_once '../classes/Form.php';
include_once '../lib/mysqli.php';
include_once '../lib/page.php';
include_once '../lib/themes.php';

unset(
    $_SESSION['change-password/index_errors'],
    $_SESSION['change-password/index_lastpost'],
    $_SESSION['close-account/index_errors'],
    $_SESSION['edit-profile/index_errors'],
    $_SESSION['edit-profile/index_lastpost'],
    $_SESSION['home/index_messages'],
    $_SESSION['tokens/index_messages']
);

if (array_key_exists('account/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['account/index_messages']);
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
    Page::imageLink('Edit Profile', '../edit-profile/', 'edit-profile'),
    Page::imageLink('Edit Theme', '../edit-theme/', "edit-$user->theme-theme"),
    Page::imageLink('Change Password', '../change-password/', 'edit-password'),
);

include_once '../fns/Tokens/countOnUser.php';
$numTokens = Tokens\countOnUser($mysqli, $idusers);

if ($numTokens) {
    $options[] = Page::imageLinkWithDescription('Remembered Sessions', "$numTokens total.", '../tokens/', 'tokens');
} else {
    $options[] = Page::imageLink('Remembered Sessions', '../tokens/', 'tokens');
}
$options[] = Page::imageLink('Close Account', '../close-account/', 'trash-bin');

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Account';
$page->finish(
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '..',
            ],
        ],
        'Account',
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
