<?php

function create_options_panel () {

    include_once __DIR__.'/../../fns/Page/imageLinkWithDescription.php';

    $options = [];

    $title = 'Forgot password?';
    $description = 'Reset your account password here.';
    $href = '../email-reset-password/';
    $icon = 'reset-password';
    $options[] = Page\imageLinkWithDescription(
        $title, $description, $href, $icon);

    $title = 'Don\'t have an account?';
    $description = 'Sign up here.';
    $href = '../sign-up/';
    $icon = 'new-password';
    $options[] = Page\imageLinkWithDescription(
        $title, $description, $href, $icon);

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
