<?php

include_once '../../lib/defaults.php';

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/Form/label.php";
$items = [Form\label('Username', $user->username)];

$email = $user->email;
if ($email !== '') {
    if ($user->email_verified) {
        $emailStatus = 'Verified';
    } else {
        include_once "$fnsDir/Users/isVerifyEmailPending.php";
        if (Users\isVerifyEmailPending($user)) $emailStatus = 'Pending';
        else $emailStatus = 'Not verified';
    }
    $items[] = Form\label('Email', "$email ($emailStatus)");
}

$full_name = $user->full_name;
if ($full_name !== '') $items[] = Form\label('Full name', $full_name);

$timezone = $user->timezone;
if ($timezone) {
    include_once "$fnsDir/Timezone/format.php";
    $items[] = Form\label('Timezone', Timezone\format($timezone));
}

include_once "$fnsDir/Theme/Brightness/index.php";
include_once "$fnsDir/Theme/Color/index.php";
$items[] = Form\label('Theme',Theme\Color\index()[$user->theme_color]
    .' - '.Theme\Brightness\index()[$user->theme_brightness]['title']);

include_once "$fnsDir/export_date_ago.php";
$value = export_date_ago($user->insert_time, true);
$items[] = Form\label('Account created', $value);

include_once "$fnsDir/bytestr.php";
$items[] = Form\label('Using storage', bytestr($user->storage_used));

include_once "$fnsDir/n_times.php";
$items[] = Form\label('Signed in', ucfirst(n_times($user->num_signins)));

include_once 'fns/create_api_keys_link.php';
include_once 'fns/create_connections_link.php';
include_once 'fns/create_tokens_link.php';
include_once 'fns/create_options_panel.php';
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/thumbnailLink.php";
include_once "$fnsDir/Page/thumbnails.php";
$content =
    Page\create(
        [
            'title' => 'Home',
            'href' => '../home/#account',
            'localNavigation' => true,
        ],
        'Account',
        Page\sessionMessages('account/messages')
        .Page\thumbnails([
            create_api_keys_link($user),
            Page\thumbnailLink('Authentication History',
                'signins/', 'sign-ins', ['id' => 'signins']),
            create_connections_link($user),
            create_tokens_link($user),
        ])
        .'<div class="hr"></div>'
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Account', $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
