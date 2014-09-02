<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/Form/label.php';
$items = [Form\label('Username', $user->username)];

$email = $user->email;
if ($email !== '') {
    $value =
        "<span>$email</span>"
        .'<span class="emailStatus">'
            .' ('.($user->email_verified ? 'Verified' : 'Not verified').')'
        .'</span>';
    $items[] = Form\label('Email', $value);
}

$full_name = $user->full_name;
if ($full_name !== '') $items[] = Form\label('Full name', $full_name);

$timezone = $user->timezone;
if ($timezone) {
    include_once '../fns/Timezone/format.php';
    $items[] = Form\label('Timezone', Timezone\format($timezone));
}

include_once '../fns/get_themes.php';
$themes = get_themes();
$items[] = Form\label('Theme', $themes[$user->theme]);

include_once '../fns/date_ago.php';
$items[] = Form\label('Account created', ucfirst(date_ago($user->insert_time)));

include_once '../fns/bytestr.php';
$items[] = Form\label('Using storage', bytestr($user->storage_used));

include_once '../fns/n_times.php';
$items[] = Form\label('Signed in', ucfirst(n_times($user->num_logins)));

include_once 'fns/create_options_panel.php';
include_once '../fns/Page/tabs.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => '../home/',
            ],
        ],
        'Account',
        Page\sessionMessages('account/messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user);

include_once '../fns/echo_page.php';
echo_page($user, 'Account', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css" href="index.css" />',
]);
