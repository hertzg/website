<?php

function create_options_panel ($user) {

    $fnsDir = __DIR__.'/../../fns';
    include_once "$fnsDir/Page/imageArrowLink.php";

    $options = [];
    if ($user->email !== '' && !$user->email_verified) {
        $options[] = Page\imageArrowLink('Verify Email',
            'verify-email/', 'yes', ['id' => 'verify-email']);
    }

    $options[] = Page\imageArrowLink('Change Password',
        'change-password/', 'edit-password', ['id' => 'change-password']);

    $options[] = Page\imageArrowLink('Edit Profile',
        'edit-profile/', 'edit-profile', ['id' => 'edit-profile']);

    $options[] = Page\imageArrowLink('Edit Theme', 'edit-theme/',
        "edit-$user->theme_color-$user->theme_brightness-theme",
        ['id' => 'edit-theme']);

    include_once __DIR__.'/create_tokens_link.php';
    $options[] = create_tokens_link($user);

    include_once __DIR__.'/create_connections_link.php';
    $options[] = create_connections_link($user);

    $title = 'API Keys';
    $href = 'api-keys/';
    $icon = 'api-keys';
    $optionsParam = ['id' => 'api-keys'];
    $num_api_keys = $user->num_api_keys;
    if ($num_api_keys) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $options[] = Page\imageArrowLinkWithDescription($title,
            "$num_api_keys total.", $href, $icon, $optionsParam);
    } else {
        $options[] = Page\imageArrowLink($title, $href, $icon, $optionsParam);
    }

    $options[] = Page\imageArrowLink('Authentication History',
        'signins/', 'sign-ins', ['id' => 'signins']);

    $options[] = Page\imageArrowLink('Close Account', 'close/', 'trash-bin', [
        'id' => 'close',
        'localNavigation' => true,
    ]);

    $content = join('<div class="hr"></div>', $options);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
