<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

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

include_once '../fns/Form/label.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageArrowLinkWithDescription.php';

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

$href = '../change-password/';
$options[] = Page\imageArrowLink('Change Password', $href, 'edit-password');

$href = '../edit-profile/';
$options[] = Page\imageArrowLink('Edit Profile', $href, 'edit-profile');

$href = '../edit-theme/';
$icon = "edit-$user->theme-theme";
$options[] = Page\imageArrowLink('Edit Theme', $href, $icon);

include_once 'fns/create_tokens_link.php';
$options[] = create_tokens_link($user);

$href = '../close-account/';
$options[] = Page\imageArrowLink('Close Account', $href, 'trash-bin');

include_once '../fns/get_themes.php';
$themes = get_themes();

$emailVerifiedText = $email_verified ? 'Verified' : 'Not verified';
$emailValue =
    "<span>$user->email</span>"
    ."<span class=\"emailStatus\"> ($emailVerifiedText)</span>";

include_once '../fns/bytestr.php';
include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/date_ago.php';
include_once '../fns/n_times.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Account',
        Page\sessionMessages('account/index_messages')
        .Form\label('Username', $user->username)
        .'<div class="hr"></div>'
        .Form\label('Email', $emailValue)
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
echo_page($user, 'Account', $content, $base, array(
    'head' => '<link rel="stylesheet" type="text/css" href="index.css" />',
));
