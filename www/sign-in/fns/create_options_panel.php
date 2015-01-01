<?php

function create_options_panel () {

    $fnsDir = __DIR__.'/../../fns';

    $options = [];

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $options[] = Page\imageArrowLinkWithDescription('Forgot password?',
        'Reset your account password here.', '../email-reset-password/',
        'reset-password', ['id' => 'email-reset-password']);

    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    $options[] = Page\imageLinkWithDescription('Don\'t have an account?',
        'Sign up here.', '../sign-up/', 'new-password');

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
