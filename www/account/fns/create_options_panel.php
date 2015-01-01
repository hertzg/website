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

    $options[] = Page\imageArrowLink('Edit Theme',
        'edit-theme/', "edit-$user->theme-theme", ['id' => 'edit-theme']);

    include_once __DIR__.'/create_tokens_link.php';
    $options[] = create_tokens_link($user);

    $title = 'Manage Connections';
    $href = 'connections/';
    $icon = 'connections';
    $optionsParam = ['id' => 'connections'];
    $num_connections = $user->num_connections;
    if ($num_connections) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $description = "$num_connections total.";
        $options[] = Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $optionsParam);
    } else {
        $options[] = Page\imageArrowLink($title, $href, $icon, $optionsParam);
    }

    $title = 'API Keys';
    $href = 'api-keys/';
    $icon = 'api-keys';
    $optionsParam = ['id' => 'api-keys'];
    $num_api_keys = $user->num_api_keys;
    if ($num_api_keys) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $description = "$num_api_keys total.";
        $options[] = Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $optionsParam);
    } else {
        $options[] = Page\imageArrowLink($title, $href, $icon, $optionsParam);
    }

    $options[] = Page\imageArrowLink('Close Account',
        'close/', 'trash-bin', ['id' => 'close']);

    $content = join('<div class="hr"></div>', $options);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
