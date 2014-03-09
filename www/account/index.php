<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/Form/label.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageArrowLinkWithDescription.php';
include_once '../lib/mysqli.php';

unset(
    $_SESSION['account/verify-email/index_errors'],
    $_SESSION['change-password/index_errors'],
    $_SESSION['change-password/index_lastpost'],
    $_SESSION['close-account/index_errors'],
    $_SESSION['edit-profile/index_errors'],
    $_SESSION['edit-profile/index_lastpost'],
    $_SESSION['home/index_messages'],
    $_SESSION['tokens/index_messages']
);

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('account/index_messages');

$fullname = $user->fullname;
if ($fullname !== '') {
    $fullnameField =
        Form\label('Full name', $fullname)
        .'<div class="hr"></div>';
} else {
    $fullnameField = '';
}

$email_verified = $user->email_verified;

$options = array();
if (!$email_verified) {
    $options[] = Page\imageArrowLink('Verify Email', 'verify-email/', 'yes');
}

$options[] = Page\imageArrowLink('Edit Profile',
    '../edit-profile/', 'edit-profile');
$options[] = Page\imageArrowLink('Edit Theme',
    '../edit-theme/', "edit-$user->theme-theme");
$options[] = Page\imageArrowLink('Change Password',
    '../change-password/', 'edit-password');

$num_tokens = $user->num_tokens;
if ($num_tokens) {
    $options[] = Page\imageArrowLinkWithDescription('Remembered Sessions',
        "$num_tokens total.", '../tokens/', 'tokens');
} else {
    $options[] = Page\imageArrowLink('Remembered Sessions',
        '../tokens/', 'tokens');
}

$options[] = Page\imageArrowLink('Close Account',
    '../close-account/', 'trash-bin');

include_once '../fns/get_themes.php';
$themes = get_themes();

include_once '../fns/bytestr.php';
include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/date_ago.php';
include_once '../fns/n_times.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Account',
        $pageMessages
        .Form\label('Username', $user->username)
        .'<div class="hr"></div>'
        .Form\label('Email', $user->email)
        .'<div class="hr"></div>'
        .Form\label('Email verified', $email_verified ? 'Yes' : 'No')
        .'<div class="hr"></div>'
        .$fullnameField
        .Form\label('Theme', $themes[$user->theme])
        .'<div class="hr"></div>'
        .Form\label('Account created', date_ago($user->inserttime))
        .'<div class="hr"></div>'
        .Form\label('Using storage', bytestr($user->storageused))
        .'<div class="hr"></div>'
        .Form\label('Signed in', n_times($user->num_logins))
    )
    .create_panel('Options', join('<div class="hr"></div>', $options));

include_once '../fns/echo_page.php';
echo_page($user, 'Account', $content, '../');
