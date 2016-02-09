<?php

function create_options_panel ($return) {

    $fnsDir = __DIR__.'/../../fns';

    if ($return === '') $queryString = '';
    else $queryString = '?return='.rawurlencode($return);

    $options = [];

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $options[] = Page\imageArrowLinkWithDescription(
        'Forgot password?', 'Reset your account password here.',
        "../email-reset-password/$queryString", 'reset-password',
        ['id' => 'email-reset-password']);

    include_once "$fnsDir/SignUpEnabled/get.php";
    if (SignUpEnabled\get()) {
        include_once "$fnsDir/Page/imageLinkWithDescription.php";
        $options[] = Page\imageLinkWithDescription("Don't have an account?",
            'Create an account here.', "../sign-up/$queryString",
            'new-password', ['localNavigation' => true]);
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
