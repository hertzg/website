<?php

function create_options_panel ($user) {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    $options = array();
    if (!$user->email_verified) {
        $title = 'Verify Email';
        $href = 'verify-email/';
        $options[] = Page\imageArrowLink($title, $href, 'yes');
    }

    $title = 'Change Password';
    $href = '../change-password/';
    $options[] = Page\imageArrowLink($title, $href, 'edit-password');

    $title = 'Edit Profile';
    $href = '../edit-profile/';
    $options[] = Page\imageArrowLink($title, $href, 'edit-profile');

    $href = '../edit-theme/';
    $icon = "edit-$user->theme-theme";
    $options[] = Page\imageArrowLink('Edit Theme', $href, $icon);

    include_once __DIR__.'/create_tokens_link.php';
    $options[] = create_tokens_link($user);

    $href = 'connections/';
    $options[] = Page\imageArrowLink('Manage Connections', $href, 'connections');

    $title = 'Close Account';
    $href = '../close-account/';
    $options[] = Page\imageArrowLink($title, $href, 'trash-bin');

    $content = join('<div class="hr"></div>', $options);

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', $content);

}
