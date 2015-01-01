<?php

function create_options_panel () {

    include_once __DIR__.'/../../fns/Page/imageLinkWithDescription.php';

    $options = [];

    $options[] = Page\imageLinkWithDescription('Forgot password?',
        'Reset your account password here.', '../email-reset-password/',
        'reset-password', ['id' => 'email-reset-password']);

    $options[] = Page\imageLinkWithDescription('Don\'t have an account?',
        'Sign up here.', '../sign-up/', 'new-password');

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
