<?php

function create_options_panel ($user) {

    $fnsDir = __DIR__.'/../../fns';
    include_once "$fnsDir/Page/imageArrowLink.php";

    if ($user->email !== '' && !$user->email_verified) {
        $content = Page\imageArrowLink('Verify Email',
            'verify-email/', 'yes', ['id' => 'verify-email'])
            .'<div class="hr"></div>';
    } else {
        $content = '';
    }

    include_once __DIR__.'/create_api_keys_link.php';
    include_once __DIR__.'/create_connections_link.php';
    include_once __DIR__.'/create_tokens_link.php';
    $content .=
        Page\imageArrowLink('Change Password', 'change-password/',
            'edit-password', ['id' => 'change-password'])
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Edit Profile',
            'edit-profile/', 'edit-profile', ['id' => 'edit-profile'])
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Edit Theme', 'edit-theme/',
            "edit-$user->theme_color-$user->theme_brightness-theme",
            ['id' => 'edit-theme'])
        .'<div class="hr"></div>'
        .create_tokens_link($user)
        .'<div class="hr"></div>'
        .create_connections_link($user)
        .'<div class="hr"></div>'
        .create_api_keys_link($user)
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Authentication History',
            'signins/', 'sign-ins', ['id' => 'signins'])
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Close Account', 'close/', 'trash-bin', [
            'id' => 'close',
            'localNavigation' => true,
        ]);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
