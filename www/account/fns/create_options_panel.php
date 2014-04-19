<?php

function create_options_panel ($user) {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    $options = [];
    if (!$user->email_verified) {
        $title = 'Verify Email';
        $options[] = Page\imageArrowLink($title, 'verify-email/', 'yes');
    }

    $title = 'Change Password';
    $href = 'change-password/';
    $options[] = Page\imageArrowLink($title, $href, 'edit-password');

    $title = 'Edit Profile';
    $options[] = Page\imageArrowLink($title, 'edit-profile/', 'edit-profile');

    $icon = "edit-$user->theme-theme";
    $options[] = Page\imageArrowLink('Edit Theme', './edit-theme/', $icon);

    include_once __DIR__.'/create_tokens_link.php';
    $options[] = create_tokens_link($user);

    $title = 'Manage Connections';
    $options[] = Page\imageArrowLink($title, 'connections/', 'connections');

    $options[] = Page\imageArrowLink('API Keys', 'api-keys/', 'TODO');

    $options[] = Page\imageArrowLink('Close Account', 'close/', 'trash-bin');

    $content = join('<div class="hr"></div>', $options);

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', $content);

}
